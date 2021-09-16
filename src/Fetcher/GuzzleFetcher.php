<?php

namespace Seatplus\EsiClient\Fetcher;

use Composer\InstalledVersions;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Seatplus\EsiClient\Configuration;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\Exceptions\InvalidAuthenticationException;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Services\RefreshToken;

class GuzzleFetcher
{
    private LogInterface $logger;
    private Client $client;

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if(! isset($this->client)) {
            $stack = HandlerStack::create();
            $stack->push(Configuration::getInstance()->getCacheMiddleware(), 'cache');

            $this->client = new Client(['handler' => $stack]);
        }

        return $this->client;
    }

    /**
     * @param Client $client
     * @return GuzzleFetcher
     */
    public function setClient(Client $client): GuzzleFetcher
    {
        $this->client = $client;

        return $this;
    }

    public function __construct(
        protected ?EsiAuthentication $authentication = null
    )
    {
        $this->logger = Configuration::getInstance()->getLogger();

    }

    public function setAuthentication(EsiAuthentication $authentication): GuzzleFetcher
    {
        $this->authentication = $authentication;

        return $this;
    }

    public function call(string $method, string $uri, array $body = [], array $headers = [])
    {

        if($this->authentication)
            $headers = array_merge($headers, [
                'Authorization' => 'Bearer ' . $this->getToken(),
            ]);

        return $this->httpRequest($method, $uri, $headers, $body);
    }

    private function getToken(): string
    {
        // Ensure that we have authentication data before we try
        // and get a token.
        if (! $this->getAuthentication())
            throw new InvalidAuthenticationException('Trying to get a token without authentication data.');

        // Check the expiry date.
        $expires = $this->carbon($this->getAuthentication()->token_expires);

        // If the token expires in the next minute, refresh it.
        if ($expires->lte($this->carbon('now')->addMinute(1)))
            $this->refreshToken();

        return $this->getAuthentication()->access_token;
    }

    /**
     * @return EsiAuthentication|null
     */
    public function getAuthentication(): ?EsiAuthentication
    {
        return $this->authentication;
    }

    public function httpRequest(string $method, string $uri, array $headers = [], array $body = [])
    {
        // Add some debug logging and start measuring how long the request took.
        $this->logger->debug('Making ' . $method . ' request to ' . $uri);
        $start = microtime(true);

        $body = count($body) > 5 ? json_encode($body) : null;

        try {
            $response = $this->getClient()->request($method, $uri, [
                RequestOptions::HEADERS => array_merge($headers, [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                    'User-Agent'   => 'Seatplus Esi Client /' . InstalledVersions::getPrettyVersion('seatplus/esi-client') . '/' . Configuration::getInstance()->http_user_agent,
                ]),
                RequestOptions::BODY => $body
            ]);

        } catch (ClientException | ServerException $e) {

            $this->logFetcherActivity('error', $e->getResponse(), $method, $uri, $start);

            $this->logger->debug(sprintf('Request for %s -> %s -> failed body was: %s',
                $method,
                $uri,
                $e->getResponse()->getBody()->getContents()
            ));

            // Raise the exception that should be handled by the caller
            throw new RequestFailedException($e, New EsiResponse(
                $e->getResponse()->getBody()->getContents(),
                $e->getResponse()->getHeaders(),
                'now',
                $e->getResponse()->getStatusCode()
            )

            );
        }

        $this->logFetcherActivity('log', $response, $method, $uri, $start);

        return new EsiResponse(
            $response->getBody()->getContents(),
            $response->getHeaders(),
            $response->hasHeader('Expires') ? $response->getHeader('Expires')[0] : 'now',
            $response->getStatusCode()
        );

    }

    private function carbon(?string $data = null)
    {
        if (! is_null($data))
            return new \Carbon\Carbon($data);

        return new \Carbon\Carbon;
    }

    private function refreshToken()
    {
        $response = (new RefreshToken($this->getAuthentication(), $this->getClient()))->getRefreshTokenResponse();

        // Get the current EsiAuth container
        $authentication = $this->getAuthentication();

        // Set the new authentication values from the request
        $authentication->access_token = $response['access_token'];
        $authentication->refresh_token = $response['refresh_token'];
        $authentication->token_expires = $this->carbon('now')->addSeconds($response['expires_in']);

        // ... and update the container
        $this->setAuthentication($authentication);
    }

    private function logFetcherActivity(string $level, ResponseInterface $response, string $method, string $uri, $start)
    {

        $is_cache_loaded = implode(';', $response->getHeader('X-Kevinrob-Cache')) === 'HIT';

        $message = $is_cache_loaded
            ? sprintf('Cache loaded for %s, [t: %s]', $uri, number_format(microtime(true) - $start, 2))
            : sprintf(
                '[http %d, %s] %s -> %s [t/e: %Fs/%s]',
                $response->getStatusCode(),
                strtolower($response->getReasonPhrase()),
                $method,
                $uri,
                number_format(microtime(true) - $start, 2),
                implode(' ', $response->getHeader('X-Esi-Error-Limit-Remain'))
            );

        match ($level) {
            'error' => $this->logger->error($message),
            'log' => $this->logger->log($message)
        };


    }


}
