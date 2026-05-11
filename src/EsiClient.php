<?php

namespace Seatplus\EsiClient;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\Exceptions\EsiScopeAccessDeniedException;
use Seatplus\EsiClient\Exceptions\InvalidAuthenticationException;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use Seatplus\EsiClient\Exceptions\UriDataMissingException;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Generated\Resources\AllianceResource;
use Seatplus\EsiClient\Generated\Resources\AssetsResource;
use Seatplus\EsiClient\Generated\Resources\CalendarResource;
use Seatplus\EsiClient\Generated\Resources\CharacterResource;
use Seatplus\EsiClient\Generated\Resources\ClonesResource;
use Seatplus\EsiClient\Generated\Resources\ContactsResource;
use Seatplus\EsiClient\Generated\Resources\ContractsResource;
use Seatplus\EsiClient\Generated\Resources\CorporationProjectsResource;
use Seatplus\EsiClient\Generated\Resources\CorporationResource;
use Seatplus\EsiClient\Generated\Resources\DogmaResource;
use Seatplus\EsiClient\Generated\Resources\FactionWarfareResource;
use Seatplus\EsiClient\Generated\Resources\FittingsResource;
use Seatplus\EsiClient\Generated\Resources\FleetsResource;
use Seatplus\EsiClient\Generated\Resources\FreelanceJobsResource;
use Seatplus\EsiClient\Generated\Resources\IncursionsResource;
use Seatplus\EsiClient\Generated\Resources\IndustryResource;
use Seatplus\EsiClient\Generated\Resources\InsuranceResource;
use Seatplus\EsiClient\Generated\Resources\KillmailsResource;
use Seatplus\EsiClient\Generated\Resources\LocationResource;
use Seatplus\EsiClient\Generated\Resources\LoyaltyResource;
use Seatplus\EsiClient\Generated\Resources\MailResource;
use Seatplus\EsiClient\Generated\Resources\MarketResource;
use Seatplus\EsiClient\Generated\Resources\MetaResource;
use Seatplus\EsiClient\Generated\Resources\PlanetaryInteractionResource;
use Seatplus\EsiClient\Generated\Resources\RoutesResource;
use Seatplus\EsiClient\Generated\Resources\SearchResource;
use Seatplus\EsiClient\Generated\Resources\SkillsResource;
use Seatplus\EsiClient\Generated\Resources\SovereigntyResource;
use Seatplus\EsiClient\Generated\Resources\StatusResource;
use Seatplus\EsiClient\Generated\Resources\UniverseResource;
use Seatplus\EsiClient\Generated\Resources\UserInterfaceResource;
use Seatplus\EsiClient\Generated\Resources\WalletResource;
use Seatplus\EsiClient\Generated\Resources\WarsResource;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Services\CheckAccess;

class EsiClient
{
    protected array $query_parameters = [];

    protected array $request_body = [];

    private readonly LogInterface $logger;

    public function __construct(
        private ?EsiAuthentication $authentication = null,
        private ?GuzzleFetcher $fetcher = null,
        private ?CheckAccess $checkAccess = null
    ) {
        $this->fetcher ??= $this->createFetcher();
        $this->logger = $this->createLogger();
        $this->checkAccess ??= new CheckAccess($this->authentication);
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
        $clone->checkAccess = new CheckAccess($clone->authentication);

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
    private function buildDataUri(string $uri, array $data, string $version, array $query_parameters): UriInterface
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
