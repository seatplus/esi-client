<?php

namespace Seatplus\EsiClient\Fetcher;

use Composer\InstalledVersions;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Exceptions\ExpiredRefreshTokenException;
use Seatplus\EsiClient\Exceptions\InvalidAuthenticationException;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Services\UpdateRefreshTokenService;

class GuzzleFetcher
{
    public function __construct(
        protected ?EsiAuthentication $authentication = null,
        protected ?UpdateRefreshTokenService $refreshTokenService = null,
        private ?LogInterface $logger = null,
        private ?Client $client = null,
    ) {
        $this->logger ??= EsiConfiguration::getInstance()->getLogger();
        $this->client ??= new Client(['handler' => $this->createHandlerStack()]);
    }

    /**
     * @throws InvalidAuthenticationException
     * @throws \Throwable
     * @throws RequestFailedException
     */
    public function call(string $method, string $uri, array $body = [], array $headers = []): EsiResponse
    {
        if ($this->authentication) {
            $headers = array_merge($headers, [
                'Authorization' => 'Bearer '.$this->getToken(),
            ]);
        }

        return $this->httpRequest($method, $uri, $headers, $body);
    }

    /**
     * @throws \Throwable
     */
    private function getToken(): string
    {
        // Check the expiry date.
        $expires = $this->carbon($this->authentication->token_expires);

        // If the token expires in the next minute, refresh it.
        throw_if($expires->lte($this->carbon('now')->addMinute(1)), new ExpiredRefreshTokenException);

        return $this->authentication->access_token;
    }

    /**
     * @throws GuzzleException
     * @throws RequestFailedException
     */
    public function httpRequest(string $method, string $uri, array $headers = [], array $body = []): EsiResponse
    {
        // Add some debug logging and start measuring how long the request took.
        $this->logger->debug('Making '.$method.' request to '.$uri);
        $start = microtime(true);

        // json encode the body if present, else null it
        $body = count($body) > 0 ? json_encode($body) : null;

        try {
            $response = $this->client->request($method, $uri, [
                RequestOptions::HEADERS => array_merge($headers, [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'Seatplus Esi Client /'.InstalledVersions::getPrettyVersion('seatplus/esi-client').'/'.EsiConfiguration::getInstance()->http_user_agent,
                ]),
                RequestOptions::BODY => $body,
            ]);
        } catch (ClientException|ServerException $e) {
            $this->logFetcherActivity('error', $e->getResponse(), $method, $uri, $start);

            $this->logger->debug(sprintf(
                'Request for %s -> %s -> failed body was: %s',
                $method,
                $uri,
                $e->getResponse()->getBody()->getContents()
            ));

            // Raise the exception that should be handled by the caller
            throw new RequestFailedException(
                $e,
                new EsiResponse(
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

    private function carbon(string $data)
    {
        return new \Carbon\Carbon($data);
    }

    private function logFetcherActivity(string $level, ResponseInterface $response, string $method, string $uri, $start): void
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
            'warning' => $this->logger->warning($message),
            'debug' => $this->logger->debug($message),
            default => $this->logger->log($message)
        };
    }

    private function createHandlerStack(): HandlerStack
    {
        $stack = HandlerStack::create();

        $stack->push(EsiConfiguration::getInstance()->getCacheMiddleware(), 'cache');

        return $stack;
    }
}
