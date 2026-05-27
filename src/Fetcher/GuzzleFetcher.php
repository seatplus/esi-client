<?php

namespace Seatplus\EsiClient\Fetcher;

use Carbon\Carbon;
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
use Seatplus\EsiClient\Exceptions\EsiErrorLimitedException;
use Seatplus\EsiClient\Exceptions\EsiRateLimitedException;
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
            $token = $this->getToken();
            $headers = array_merge($headers, [
                'Authorization' => "Bearer {$token}",
            ]);
        }

        return $this->httpRequest($method, $uri, $headers, $body);
    }

    /**
     * @throws \Throwable
     */
    private function getToken(): string
    {
        $expires = $this->carbon($this->authentication->token_expires);

        throw_if($expires->lte($this->carbon('now')->addMinute()), new ExpiredRefreshTokenException);

        return $this->authentication->access_token;
    }

    /**
     * @throws GuzzleException
     * @throws EsiRateLimitedException
     * @throws EsiErrorLimitedException
     * @throws RequestFailedException
     */
    public function httpRequest(string $method, string $uri, array $headers = [], array $body = []): EsiResponse
    {
        $this->logger->debug("Making {$method} request to {$uri}");
        $start = microtime(true);

        $body = count($body) > 0 ? json_encode($body) : null;

        $version = InstalledVersions::getPrettyVersion('seatplus/esi-client');
        $userAgent = EsiConfiguration::getInstance()->http_user_agent;
        $userAgentHeader = "seatplus/esi-client/{$version} +https://github.com/seatplus/esi-client";

        if ($userAgent !== '') {
            $userAgentHeader .= " {$userAgent}";
        }

        $requestHeaders = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'User-Agent' => $userAgentHeader,
        ]);

        if (EsiConfiguration::getInstance()->compatibility_date !== null) {
            $requestHeaders['X-Compatibility-Date'] = EsiConfiguration::getInstance()->compatibility_date;
        }

        try {
            $response = $this->client->request($method, $uri, [
                RequestOptions::HEADERS => $requestHeaders,
                RequestOptions::BODY => $body,
            ]);
        } catch (ClientException|ServerException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $this->logFetcherActivity('error', $e->getResponse(), $method, $uri, $start);

            $body = $e->getResponse()->getBody()->getContents();
            $this->logger->debug("Request for {$method} -> {$uri} -> failed body was: {$body}");

            if ($statusCode === 429) {
                $retryAfter = (int) ($e->getResponse()->getHeader('Retry-After')[0] ?? 60);

                throw new EsiRateLimitedException($retryAfter);
            }

            if ($statusCode === 420) {
                $retryAfter = (int) ($e->getResponse()->getHeader('X-Esi-Error-Limit-Reset')[0] ?? 60);

                throw new EsiErrorLimitedException($retryAfter);
            }

            throw new RequestFailedException(
                $e,
                new EsiResponse(
                    $e->getResponse()->getBody()->getContents(),
                    $e->getResponse()->getHeaders(),
                    'now',
                    $statusCode
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

    private function carbon(string $data): Carbon
    {
        return new Carbon($data);
    }

    private function logFetcherActivity(string $level, ResponseInterface $response, string $method, string $uri, float|string $start): void
    {
        $isCacheLoaded = implode(';', $response->getHeader('X-Kevinrob-Cache')) === 'HIT';
        $elapsed = number_format(microtime(true) - $start, 2);

        if ($isCacheLoaded) {
            $message = "Cache loaded for {$uri}, [t: {$elapsed}]";
        } else {
            $status = $response->getStatusCode();
            $reason = strtolower($response->getReasonPhrase());
            $errorLimitRemain = implode(' ', $response->getHeader('X-Esi-Error-Limit-Remain'));
            $ratelimitRemaining = implode(' ', $response->getHeader('X-Ratelimit-Remaining'));
            $message = "[http {$status}, {$reason}] {$method} -> {$uri} [t/e: {$elapsed}s/{$errorLimitRemain} ratelimit-remaining: {$ratelimitRemaining}]";
        }

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
