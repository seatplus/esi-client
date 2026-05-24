<?php

namespace Seatplus\EsiClient;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\Exceptions\InvalidAuthenticationException;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use Seatplus\EsiClient\Exceptions\UriDataMissingException;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiSchema\Contracts\EsiCursor;
use Seatplus\EsiSchema\Contracts\EsiRawResponse;
use Seatplus\EsiSchema\Contracts\EsiTransportInterface;
use Seatplus\EsiSchema\Contracts\ScopeAccessDeniedException;

class EsiClient implements EsiTransportInterface
{
    protected array $query_parameters = [];

    protected array $request_body = [];

    private readonly LogInterface $logger;

    public function __construct(
        private ?EsiAuthentication $authentication = null,
        private ?GuzzleFetcher $fetcher = null,
    ) {
        $this->fetcher ??= $this->createFetcher();
        $this->logger = $this->createLogger();
    }

    /**
     * Return a new client instance with the given OAuth access token set.
     * Use this for authenticated ESI endpoints.
     */
    public function withToken(string $accessToken): static
    {
        $clone = clone $this;
        $clone->authentication = new EsiAuthentication(
            access_token: $accessToken,
            refresh_token: '',
        );
        $clone->fetcher = $clone->createFetcher();

        return $clone;
    }

    private function createFetcher(): GuzzleFetcher
    {
        /** @var string $fetcher_class */
        $fetcher_class = $this->getConfiguration('fetcher');

        return new $fetcher_class($this->authentication);
    }

    /**
     * @throws RequestFailedException
     * @throws \Throwable
     * @throws UriDataMissingException
     * @throws InvalidAuthenticationException
     * @throws ScopeAccessDeniedException
     */
    public function invoke(
        string $method,
        string $path,
        array $pathValues = [],
        array $queryParams = [],
        array $requestBody = [],
    ): EsiRawResponse {
        $uri = $this->buildDataUri($path, $pathValues, $queryParams);
        $response = $this->fetcher->call($method, $uri, $requestBody);

        // Extract cursor tokens if the response body contains a `cursor` object.
        // Cursor routes (x-pagination: cursor) embed {before, after} in the body.
        $cursor = null;
        if (isset($response->data->cursor) && is_object($response->data->cursor)) {
            $c = $response->data->cursor;
            $cursor = new EsiCursor(
                before: isset($c->before) ? (string) $c->before : null,
                after: isset($c->after) ? (string) $c->after : null,
            );
        }

        return new EsiRawResponse(
            data: $response->data,
            isCachedLoad: $response->isCachedLoad(),
            pages: $response->pages ?? 1,
            cursor: $cursor,
            rateLimitRemaining: $response->ratelimitRemaining,
            rateLimitUsed: $response->ratelimitUsed,
            retryAfter: $response->retryAfter,
            errorLimitRemaining: $response->error_limit_remain,
            errorLimitReset: $response->error_limit_reset,
        );
    }

    /**
     * Assert that the current token possesses the required OAuth2 scope.
     * Null = public endpoint — no-op.
     *
     * @throws ScopeAccessDeniedException
     */
    public function assertScope(?string $scope): void
    {
        if ($scope === null) {
            return;
        }

        $scopes = $this->authentication?->getScopes() ?? [];

        if (! in_array($scope, $scopes, true)) {
            $this->logger->warning("Scope check failed: {$scope} not in token.");
            throw new ScopeAccessDeniedException($scope);
        }
    }

    private function createLogger(): LogInterface
    {
        return $this->getConfiguration()->getLogger();
    }

    private function getConfiguration(?string $property = null): EsiConfiguration|string
    {
        return $property ? EsiConfiguration::getInstance()->$property : EsiConfiguration::getInstance();
    }

    /**
     * @throws UriDataMissingException
     */
    private function buildDataUri(string $uri, array $data, array $query_parameters): UriInterface
    {
        $query_params = array_merge(['datasource' => $this->getConfiguration('datasource')], $query_parameters);

        $trimmed = trim($this->mapDataToUri($uri, $data), '/');
        $path = "/{$trimmed}/";

        return Uri::fromParts([
            'scheme' => $this->getConfiguration('esi_scheme'),
            'host' => $this->getConfiguration('esi_host'),
            'port' => $this->getConfiguration('esi_port'),
            'path' => $path,
            'query' => http_build_query($query_params),
        ]);
    }

    /**
     * @throws UriDataMissingException
     */
    private function mapDataToUri(string $uri, array $data): string
    {
        if (preg_match_all('/{+(.*?)}/', $uri, $matches)) {
            if (empty($data)) {
                throw new UriDataMissingException("The data array for the uri {$uri} is empty. Please provide data to use.");
            }

            foreach ($matches[1] as $match) {
                if (! array_key_exists($match, $data)) {
                    throw new UriDataMissingException("Data for {$match} is missing. Please provide this by setting a value for {$match}.");
                }
                $uri = str_replace("{{$match}}", $data[$match], $uri);
            }
        }

        return $uri;
    }
}
