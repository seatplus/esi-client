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
use Seatplus\EsiSchema\Resources\AllianceResource;
use Seatplus\EsiSchema\Resources\AssetsResource;
use Seatplus\EsiSchema\Resources\CalendarResource;
use Seatplus\EsiSchema\Resources\CharacterResource;
use Seatplus\EsiSchema\Resources\ClonesResource;
use Seatplus\EsiSchema\Resources\ContactsResource;
use Seatplus\EsiSchema\Resources\ContractsResource;
use Seatplus\EsiSchema\Resources\CorporationProjectsResource;
use Seatplus\EsiSchema\Resources\CorporationResource;
use Seatplus\EsiSchema\Resources\DogmaResource;
use Seatplus\EsiSchema\Resources\FactionWarfareResource;
use Seatplus\EsiSchema\Resources\FittingsResource;
use Seatplus\EsiSchema\Resources\FleetsResource;
use Seatplus\EsiSchema\Resources\FreelanceJobsResource;
use Seatplus\EsiSchema\Resources\IncursionsResource;
use Seatplus\EsiSchema\Resources\IndustryResource;
use Seatplus\EsiSchema\Resources\InsuranceResource;
use Seatplus\EsiSchema\Resources\KillmailsResource;
use Seatplus\EsiSchema\Resources\LocationResource;
use Seatplus\EsiSchema\Resources\LoyaltyResource;
use Seatplus\EsiSchema\Resources\MailResource;
use Seatplus\EsiSchema\Resources\MarketResource;
use Seatplus\EsiSchema\Resources\MetaResource;
use Seatplus\EsiSchema\Resources\PlanetaryInteractionResource;
use Seatplus\EsiSchema\Resources\RoutesResource;
use Seatplus\EsiSchema\Resources\SearchResource;
use Seatplus\EsiSchema\Resources\SkillsResource;
use Seatplus\EsiSchema\Resources\SovereigntyResource;
use Seatplus\EsiSchema\Resources\StatusResource;
use Seatplus\EsiSchema\Resources\UniverseResource;
use Seatplus\EsiSchema\Resources\UserInterfaceResource;
use Seatplus\EsiSchema\Resources\WalletResource;
use Seatplus\EsiSchema\Resources\WarsResource;

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
     *
     * @example $esi->withToken($accessToken)->characters()->getCharactersCharacterId($id)
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

    // -------------------------------------------------------------------------
    // Resource factory methods (one per ESI tag group)
    // -------------------------------------------------------------------------

    public function alliance(): AllianceResource
    {
        return new AllianceResource($this);
    }

    public function assets(): AssetsResource
    {
        return new AssetsResource($this);
    }

    public function calendar(): CalendarResource
    {
        return new CalendarResource($this);
    }

    public function characters(): CharacterResource
    {
        return new CharacterResource($this);
    }

    public function clones(): ClonesResource
    {
        return new ClonesResource($this);
    }

    public function contacts(): ContactsResource
    {
        return new ContactsResource($this);
    }

    public function contracts(): ContractsResource
    {
        return new ContractsResource($this);
    }

    public function corporation(): CorporationResource
    {
        return new CorporationResource($this);
    }

    public function dogma(): DogmaResource
    {
        return new DogmaResource($this);
    }

    public function factionWarfare(): FactionWarfareResource
    {
        return new FactionWarfareResource($this);
    }

    public function fittings(): FittingsResource
    {
        return new FittingsResource($this);
    }

    public function fleets(): FleetsResource
    {
        return new FleetsResource($this);
    }

    public function incursions(): IncursionsResource
    {
        return new IncursionsResource($this);
    }

    public function industry(): IndustryResource
    {
        return new IndustryResource($this);
    }

    public function insurance(): InsuranceResource
    {
        return new InsuranceResource($this);
    }

    public function killmails(): KillmailsResource
    {
        return new KillmailsResource($this);
    }

    public function location(): LocationResource
    {
        return new LocationResource($this);
    }

    public function loyalty(): LoyaltyResource
    {
        return new LoyaltyResource($this);
    }

    public function mail(): MailResource
    {
        return new MailResource($this);
    }

    public function market(): MarketResource
    {
        return new MarketResource($this);
    }

    public function planetaryInteraction(): PlanetaryInteractionResource
    {
        return new PlanetaryInteractionResource($this);
    }

    public function routes(): RoutesResource
    {
        return new RoutesResource($this);
    }

    public function search(): SearchResource
    {
        return new SearchResource($this);
    }

    public function skills(): SkillsResource
    {
        return new SkillsResource($this);
    }

    public function sovereignty(): SovereigntyResource
    {
        return new SovereigntyResource($this);
    }

    public function status(): StatusResource
    {
        return new StatusResource($this);
    }

    public function universe(): UniverseResource
    {
        return new UniverseResource($this);
    }

    public function userInterface(): UserInterfaceResource
    {
        return new UserInterfaceResource($this);
    }

    public function wallet(): WalletResource
    {
        return new WalletResource($this);
    }

    public function wars(): WarsResource
    {
        return new WarsResource($this);
    }

    public function corporationProjects(): CorporationProjectsResource
    {
        return new CorporationProjectsResource($this);
    }

    public function freelanceJobs(): FreelanceJobsResource
    {
        return new FreelanceJobsResource($this);
    }

    public function meta(): MetaResource
    {
        return new MetaResource($this);
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
        // Enrich the uri
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
        // Create a query string for the URI. We automatically
        // include the datasource value from the configuration.
        $query_params = array_merge(['datasource' => $this->getConfiguration('datasource')], $query_parameters);

        $path = sprintf(
            '/latest/%s/',
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
}
