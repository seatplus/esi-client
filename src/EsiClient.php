<?php

namespace Seatplus\EsiClient;

use GuzzleHttp\Psr7\Uri;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\Exceptions\EsiScopeAccessDeniedException;
use Seatplus\EsiClient\Exceptions\UriDataMissingException;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Services\CheckAccess;

class EsiClient
{
    protected string $version = 'latest';

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return array
     */
    public function getQueryParameters(): array
    {
        return $this->query_parameters;
    }

    /**
     * @param array $query_parameters
     */
    public function setQueryParameters(array $query_parameters): void
    {
        foreach ($query_parameters as $key => $value) {
            if (is_array($value)) {
                $query[$key] = implode(',', $value);
            }
        }

        $this->query_parameters = array_merge($this->query_parameters, $query_parameters);
    }

    /**
     * @return array
     */
    public function getRequestBody(): array
    {
        return $this->request_body;
    }

    /**
     * @param array $request_body
     */
    public function setRequestBody(array $request_body): void
    {
        $this->request_body = $request_body;
    }

    protected array $query_parameters = [];
    protected array $request_body = [];

    private LogInterface $logger;

    public function __construct()
    {
        // Setup the logger
        $this->logger = $this->getLogger();

        //TODO return $this; // Maybe not needed
    }

    /**
     * @return EsiAuthentication|null
     */
    public function getAuthentication(): ?EsiAuthentication
    {
        if (isset($this->authentication)) {
            return $this->authentication;
        }

        return null;
    }

    /**
     * @param EsiAuthentication|null $authentication
     */
    public function setAuthentication(EsiAuthentication $authentication): void
    {
        $this->authentication = $authentication;
    }

    /**
     * @throws EsiScopeAccessDeniedException
     */
    public function invoke(string $method, string $uri_original, array $uri_data = [])
    {

        // Enrich the uri
        $uri = $this->buildDataUri($uri_original, $uri_data);

        // First check if access requirements are met
        if (! $this->getAccessChecker()->can($method, $uri_original)) {

            // Log the deny.
            $this->logger->warning('Access denied to ' . $uri . ' due to ' .
                'missing scopes.');

            throw new EsiScopeAccessDeniedException('Access denied to ' . $uri);
        }

        // Fetcher will take care of caching
        $result = $this->getFetcher()->call($method, $uri, $this->getRequestBody());

        // In preparation for the next request, perform some
        // self cleanups of this objects request data such as
        // query string parameters and post bodies.
        $this->request_body = [];
        $this->query_parameters = [];

        return $result;
    }

    private function getLogger() : LogInterface
    {
        return $this->getConfiguration()->getLogger();
    }

    private function getConfiguration(): Configuration
    {
        return Configuration::getInstance();
    }

    private function buildDataUri(string $uri, array $data): Uri
    {

        // Create a query string for the URI. We automatically
        // include the datasource value from the configuration.
        $query_params = array_merge([
            'datasource' => $this->getConfiguration()->datasource,
        ], $this->getQueryParameters());

        $path = sprintf(
            '/%s/%s/',
            rtrim($this->getVersion(), '/'), // remove a potential tailing slash,
            trim($this->mapDataToUri($uri, $data), '/')
        );

        return Uri::fromParts([
            'scheme' => $this->getConfiguration()->esi_scheme,
            'host' => $this->getConfiguration()->esi_host,
            'port' => $this->getConfiguration()->esi_port,
            'path' => $path,
            'query' => http_build_query($query_params),
        ]);
    }

    private function mapDataToUri(string $uri, array $data): string
    {

        // Extract fields in curly braces. If there are fields,
        // replace the data with those in the URI
        if (preg_match_all('/{+(.*?)}/', $uri, $matches)) {
            if (empty($data)) {
                throw new UriDataMissingException(
                    'The data array for the uri ' . $uri . ' is empty. Please provide data to use.'
                );
            }

            foreach ($matches[1] as $match) {
                if (! array_key_exists($match, $data)) {
                    throw new UriDataMissingException(
                        'Data for ' . $match . ' is missing. Please provide this by setting a value ' .
                        'for ' . $match . '.'
                    );
                }

                $uri = str_replace('{' . $match . '}', $data[$match], $uri);
            }
        }

        return $uri;
    }

    private function getAccessChecker()
    {
        return new CheckAccess($this->getAuthentication());
    }

    private function getFetcher(): GuzzleFetcher
    {
        if (! isset($this->fetcher)) {
            $fetcher_class = $this->getConfiguration()->fetcher;
            $this->fetcher = new $fetcher_class(...[$this->getAuthentication()]);
        }

        return $this->fetcher;
    }
}
