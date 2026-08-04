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
use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Exceptions\EsiErrorLimitedException;
use Seatplus\EsiClient\Exceptions\EsiRateLimitedException;
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

it('throws EsiRateLimitedException on 429 with Retry-After header', function () {
    $mock = new MockHandler([
        new Response(429, ['Retry-After' => '30'], json_encode(['error' => 'Rate limited'])),
    ]);

    $client = new Client(['handler' => HandlerStack::create($mock)]);
    $fetcher = new GuzzleFetcher(client: $client);

    $fetcher->call('get', '/foo');
})->throws(EsiRateLimitedException::class);

it('throws EsiRateLimitedException with correct retryAfter from header', function () {
    $mock = new MockHandler([
        new Response(429, ['Retry-After' => '45'], json_encode(['error' => 'Rate limited'])),
    ]);

    $client = new Client(['handler' => HandlerStack::create($mock)]);
    $fetcher = new GuzzleFetcher(client: $client);

    try {
        $fetcher->call('get', '/foo');
    } catch (EsiRateLimitedException $e) {
        expect($e->retryAfter)->toBe(45);
    }
});

it('throws EsiRateLimitedException with default retryAfter when header absent', function () {
    $mock = new MockHandler([
        new Response(429, [], json_encode(['error' => 'Rate limited'])),
    ]);

    $client = new Client(['handler' => HandlerStack::create($mock)]);
    $fetcher = new GuzzleFetcher(client: $client);

    try {
        $fetcher->call('get', '/foo');
    } catch (EsiRateLimitedException $e) {
        expect($e->retryAfter)->toBe(60);
    }
});

it('throws EsiErrorLimitedException on 420', function () {
    $mock = new MockHandler([
        new Response(420, [], json_encode(['error' => 'Error limited'])),
    ]);

    $client = new Client(['handler' => HandlerStack::create($mock)]);
    $fetcher = new GuzzleFetcher(client: $client);

    $fetcher->call('get', '/foo');
})->throws(EsiErrorLimitedException::class);

it('EsiErrorLimitedException has retryAfter of 60', function () {
    $mock = new MockHandler([
        new Response(420, [], json_encode(['error' => 'Error limited'])),
    ]);

    $client = new Client(['handler' => HandlerStack::create($mock)]);
    $fetcher = new GuzzleFetcher(client: $client);

    try {
        $fetcher->call('get', '/foo');
    } catch (EsiErrorLimitedException $e) {
        expect($e->retryAfter)->toBe(60);
    }
});

it('sends X-Compatibility-Date header when configured', function () {
    $sentHeaders = [];

    $mock = new MockHandler([
        new Response(200, [], json_encode(['foo' => 'bar'])),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $handlerStack->push(function (callable $handler) use (&$sentHeaders) {
        return function ($request, array $options) use ($handler, &$sentHeaders) {
            $sentHeaders = $request->getHeaders();

            return $handler($request, $options);
        };
    });

    EsiConfiguration::resetInstance();
    $config = EsiConfiguration::getInstance(compatibility_date: '2025-10-01');

    $client = new Client(['handler' => $handlerStack]);
    $fetcher = new GuzzleFetcher(client: $client);
    $fetcher->call('get', '/foo');

    expect($sentHeaders)->toHaveKey('X-Compatibility-Date')
        ->and($sentHeaders['X-Compatibility-Date'][0])->toBe('2025-10-01');

    EsiConfiguration::resetInstance();
});

it('does not send X-Compatibility-Date header when compatibility_date is null', function () {
    $sentHeaders = [];

    EsiConfiguration::resetInstance();
    EsiConfiguration::getInstance(compatibility_date: null);

    $mock = new MockHandler([
        new Response(200, [], json_encode(['foo' => 'bar'])),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $handlerStack->push(function (callable $handler) use (&$sentHeaders) {
        return function ($request, array $options) use ($handler, &$sentHeaders) {
            $sentHeaders = $request->getHeaders();

            return $handler($request, $options);
        };
    });

    $client = new Client(['handler' => $handlerStack]);
    $fetcher = new GuzzleFetcher(client: $client);
    $fetcher->call('get', '/foo');

    expect($sentHeaders)->not->toHaveKey('X-Compatibility-Date');

    EsiConfiguration::resetInstance();
});

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

it('logs rate-limit metrics only when ESI returns those headers', function () {
    $response = mock(ResponseInterface::class, function (MockInterface $mock) {
        $mock->shouldReceive('getHeader')->with('X-Kevinrob-Cache')->andReturn([]);
        $mock->shouldReceive('getHeader')->with('X-Esi-Error-Limit-Remain')->andReturn(['95']);
        $mock->shouldReceive('getHeader')->with('X-Ratelimit-Remaining')->andReturn(['80']);
        $mock->shouldReceive('getStatusCode')->andReturn(200);
        $mock->shouldReceive('getReasonPhrase')->andReturn('OK');
    });

    $logger = mock(LogInterface::class, function (MockInterface $logger) {
        $logger->shouldReceive('log')
            ->once()
            ->with(Mockery::on(fn (string $message): bool => str_contains($message, 'error-limit: 95')
                && str_contains($message, 'ratelimit-remaining: 80')));
    });

    $fetcher = new GuzzleFetcher(logger: $logger);

    $reflection = new ReflectionClass($fetcher);
    $method = $reflection->getMethod('logFetcherActivity');

    $method->invokeArgs($fetcher, ['info', $response, 'GET', '/test/uri', microtime(true)]);
});

it('omits rate-limit metrics when ESI does not return those headers', function () {
    $response = mock(ResponseInterface::class, function (MockInterface $mock) {
        $mock->shouldReceive('getHeader')->with('X-Kevinrob-Cache')->andReturn([]);
        $mock->shouldReceive('getHeader')->with('X-Esi-Error-Limit-Remain')->andReturn([]);
        $mock->shouldReceive('getHeader')->with('X-Ratelimit-Remaining')->andReturn([]);
        $mock->shouldReceive('getStatusCode')->andReturn(200);
        $mock->shouldReceive('getReasonPhrase')->andReturn('OK');
    });

    $logger = mock(LogInterface::class, function (MockInterface $logger) {
        $logger->shouldReceive('log')
            ->once()
            ->with(Mockery::on(fn (string $message): bool => ! str_contains($message, 'error-limit:')
                && ! str_contains($message, 'ratelimit-remaining:')));
    });

    $fetcher = new GuzzleFetcher(logger: $logger);

    $reflection = new ReflectionClass($fetcher);
    $method = $reflection->getMethod('logFetcherActivity');

    $method->invokeArgs($fetcher, ['info', $response, 'GET', '/test/uri', microtime(true)]);
});
