<?php

use GuzzleHttp\Psr7\Uri;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\EsiClient;
use Seatplus\EsiClient\Exceptions\UriDataMissingException;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiSchema\Contracts\EsiRawResponse;
use Seatplus\EsiSchema\Contracts\ScopeAccessDeniedException;

beforeEach(function () {
    $this->fetcherMock = mock(GuzzleFetcher::class);
    $this->authentication = new EsiAuthentication('token', 'refresh_token');
    $this->client = new EsiClient($this->authentication, $this->fetcherMock);
});

afterEach(function () {
    Mockery::close();
});

it('invokes API call successfully', function () {
    $this->fetcherMock->shouldReceive('call')
        ->once()
        ->andReturn(new EsiResponse('{}', [], 'now', 200));

    $response = $this->client->invoke('GET', '/alliances/{alliance_id}/', ['alliance_id' => 123]);

    expect($response)->toBeInstanceOf(EsiRawResponse::class);
});

it('throws exception for missing URI data', function () {
    $uri = '/test/uri/{id}';

    expect(fn () => $this->client->invoke('GET', $uri))->toThrow(UriDataMissingException::class);
});

it('assertScope passes for null (public endpoint)', function () {
    $client = new EsiClient;

    // Should not throw for public endpoints
    $client->assertScope(null);
    expect(true)->toBeTrue();
});

it('assertScope throws when scope is missing from token', function () {
    $token = buildJWT(json_encode(['scp' => ['esi-assets.read_assets.v1']]));
    $authentication = new EsiAuthentication($token, '');
    $client = new EsiClient($authentication, $this->fetcherMock);

    expect(fn () => $client->assertScope('esi-mail.read_mail.v1'))
        ->toThrow(ScopeAccessDeniedException::class);
});

it('assertScope passes when scope is present in token', function () {
    $token = buildJWT(json_encode(['scp' => ['esi-assets.read_assets.v1']]));
    $authentication = new EsiAuthentication($token, '');
    $client = new EsiClient($authentication, $this->fetcherMock);

    // Should not throw
    $client->assertScope('esi-assets.read_assets.v1');
    expect(true)->toBeTrue();
});

it('assertScope throws when authentication is null', function () {
    $client = new EsiClient(null, $this->fetcherMock);

    expect(fn () => $client->assertScope('esi-assets.read_assets.v1'))
        ->toThrow(ScopeAccessDeniedException::class);
});

it('builds correct data URI', function () {
    $reflection = new ReflectionClass($this->client);
    $method = $reflection->getMethod('buildDataUri');

    $uri = $method->invokeArgs($this->client, ['/test/uri/{id}', ['id' => 123], ['param' => 'value']]);

    expect($uri)->toBeInstanceOf(Uri::class)
        ->and((string) $uri)->toBe('https://esi.evetech.net/latest/test/uri/123/?datasource=tranquility&param=value');
});

it('throws exception for missing data', function () {
    $uri = '/test/uri/{foo}/{bar}';
    $data = ['foo' => 'one']; // missing bar

    // Assuming $client is an instance of EsiClient
    $reflection = new ReflectionClass($this->client);
    $method = $reflection->getMethod('mapDataToUri');
    // $method->setAccessible(true);

    expect(fn () => $method->invokeArgs($this->client, [$uri, $data]))->toThrow(UriDataMissingException::class);
});

it('invoke populates rate-limit fields from response headers', function () {
    $esiResponse = new EsiResponse(
        '{"name":"Test"}',
        [
            'X-Ratelimit-Remaining' => ['42'],
            'X-Ratelimit-Used' => ['8'],
            'X-Ratelimit-Limit' => ['1800/15m'],
            'X-Ratelimit-Group' => ['char-asset'],
        ],
        'now',
        200,
    );

    $this->fetcherMock->shouldReceive('call')->once()->andReturn($esiResponse);

    $response = $this->client->invoke('GET', '/alliances/{alliance_id}/', ['alliance_id' => 123]);

    expect($response->rateLimitRemaining)->toBe(42)
        ->and($response->rateLimitUsed)->toBe(8)
        ->and($response->retryAfter)->toBeNull();
});

it('invoke extracts cursor from response body', function () {
    $body = json_encode([
        'cursor' => ['before' => 'tok_abc', 'after' => 'tok_xyz'],
        'freelance_jobs' => [],
    ]);

    $esiResponse = new EsiResponse($body, [], 'now', 200);
    $this->fetcherMock->shouldReceive('call')->once()->andReturn($esiResponse);

    $response = $this->client->invoke('GET', '/freelance-jobs', []);

    expect($response->cursor)->not->toBeNull()
        ->and($response->cursor->before)->toBe('tok_abc')
        ->and($response->cursor->after)->toBe('tok_xyz');
});

it('creates fetcher instance', function () {
    $reflection = new ReflectionClass($this->client);
    $method = $reflection->getMethod('createFetcher');
    $method->setAccessible(true);

    $fetcher = $method->invoke($this->client);

    expect($fetcher)->toBeInstanceOf(GuzzleFetcher::class);
});

it('invoke sets cursor to null when not in response body', function () {
    $esiResponse = new EsiResponse('{"name":"Test"}', [], 'now', 200);
    $this->fetcherMock->shouldReceive('call')->once()->andReturn($esiResponse);

    $response = $this->client->invoke('GET', '/alliances/{alliance_id}/', ['alliance_id' => 123]);

    expect($response->cursor)->toBeNull();
});
