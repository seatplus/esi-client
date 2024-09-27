<?php

namespace Seatplus\EsiClient;

use GuzzleHttp\Psr7\Uri;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\Exceptions\EsiScopeAccessDeniedException;
use Seatplus\EsiClient\Exceptions\InvalidAuthenticationException;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use Seatplus\EsiClient\Exceptions\UriDataMissingException;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Services\CheckAccess;

class EsiClient
{
    protected array $query_parameters = [];

    protected array $request_body = [];

    private LogInterface $logger;

    public function __construct(
        private readonly ?EsiAuthentication $authentication = null,
        private ?GuzzleFetcher $fetcher = null,
        private ?CheckAccess $checkAccess = null
    ) {
        $this->fetcher ??= $this->createFetcher();
        $this->logger = $this->createLogger();
        $this->checkAccess ??= new CheckAccess($this->authentication);
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
     * @throws EsiScopeAccessDeniedException
     */
    public function invoke(
        string $method,
        string $uri_original,
        array $uri_data = [],
        string $version = 'latest',
        array $query_parameters = [],
        array $request_body = []
    ): EsiResponse {
        // Enrich the uri
        $uri = $this->buildDataUri($uri_original, $uri_data, $version, $query_parameters);

        // First check if access requirements are met
        if (! $this->hasAccess($method, $uri_original)) {
            // Log the deny.
            $this->logger->warning("Access denied to {$uri} due to missing scopes.");
            throw new EsiScopeAccessDeniedException("Access denied to {$uri}");
        }

        // Fetcher will take care of caching
        return $this->fetcher->call($method, $uri, $request_body);
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
    private function buildDataUri(string $uri, array $data, string $version, array $query_parameters): \Psr\Http\Message\UriInterface
    {
        // Create a query string for the URI. We automatically
        // include the datasource value from the configuration.
        $query_params = array_merge(['datasource' => $this->getConfiguration('datasource')], $query_parameters);

        $path = sprintf(
            '/%s/%s/',
            rtrim($version, '/'), // remove a potential tailing slash,
            trim($this->mapDataToUri($uri, $data), '/')
        );

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
        // Extract fields in curly braces. If there are fields,
        // replace the data with those in the URI
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

    private function hasAccess(string $method, string $uri_original): bool
    {
        return $this->checkAccess->can($method, $uri_original);
    }
}
