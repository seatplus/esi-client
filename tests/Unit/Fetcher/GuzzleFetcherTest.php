<?php

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Psr\Http\Message\ResponseInterface;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\Exceptions\ExpiredRefreshTokenException;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\LogInterface;

test('guzzle calling without authorization', function () {
    $mock = new MockHandler([
        new Response(200, [], json_encode(['foo' => 'bar'])),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    $fetcher = new GuzzleFetcher(client: $client);

    $response = $fetcher->call('get', '/foo');

    expect($response)->toBeInstanceOf(EsiResponse::class);
});

test('guzzle calling with authorization', function () {
    $mock = new MockHandler([
        new Response(200, [], json_encode(['foo' => 'bar'])),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    $authentication = new EsiAuthentication(
        // ESI client_id and secret specific
        access_token: '_',
        refresh_token: 'baz',
        // refresh_token specific
        client_id: 1234,
        secret: 'bar',
        token_expires: Carbon::now()->addHour(),
    );

    $fetcher = new GuzzleFetcher(authentication: $authentication, client: $client);

    $response = $fetcher->call('get', '/foo');

    expect($response)->toBeInstanceOf(EsiResponse::class);
});

it('throws outdated refresh_token exception if expires_in is expired or to close in the future', function (string $token_expires) {
    $authentication = new EsiAuthentication(
        // ESI client_id and secret specific
        access_token: '_',
        refresh_token: 'baz',
        // refresh_token specific
        client_id: 1234,
        secret: 'bar',
        token_expires: $token_expires,
    );

    $fetcher = new GuzzleFetcher(authentication: $authentication);

    $fetcher->call('get', '/foo');
})->with(['1970-01-01 00:00:00', Carbon::now()->addSeconds(50)->toDateTimeString()])
    ->throws(ExpiredRefreshTokenException::class);

it('trows RequestFailedException', function () {
    $mock = new MockHandler([
        new Response(401, ['foo' => 'bar'], 'test'),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    $fetcher = new GuzzleFetcher(client: $client);

    $fetcher->call('get', '/foo');
})->throws(RequestFailedException::class);

it('logs fetcher activity with cache hit', function (string $log_level) {
    // Create a mock ResponseInterface
    $response = mock(ResponseInterface::class, function (MockInterface $mock) {
        $mock->shouldReceive('getHeader')
            ->with('X-Kevinrob-Cache')
            ->andReturn(['HIT']);
        $mock->shouldReceive('getStatusCode')
            ->andReturn(200);
        $mock->shouldReceive('getReasonPhrase')
            ->andReturn('OK');
    });

    // Create a mock LoggerInterface
    $logger = mock(LogInterface::class, function (MockInterface $logger) use ($log_level) {

        if ($log_level === 'info') {
            $log_level = 'log';
        }

        $logger->shouldReceive($log_level)
            ->once()
            ->with(Mockery::type('string'));
    });

    // Create an instance of GuzzleFetcher with the mock logger
    $fetcher = new GuzzleFetcher(logger: $logger);

    // Use reflection to access the private logFetcherActivity method
    $reflection = new ReflectionClass($fetcher);
    $method = $reflection->getMethod('logFetcherActivity');

    // Invoke the method
    $method->invokeArgs($fetcher, [$log_level, $response, 'GET', '/test/uri', microtime(true)]);
})->with(['error', 'info', 'debug', 'warning']);
