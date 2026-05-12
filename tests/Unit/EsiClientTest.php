<?php

use GuzzleHttp\Psr7\Uri;
use Mockery\MockInterface;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\EsiClient;
use Seatplus\EsiClient\Exceptions\EsiScopeAccessDeniedException;
use Seatplus\EsiClient\Exceptions\UriDataMissingException;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Services\CheckAccess;
use Seatplus\EsiSchema\Contracts\EsiRawResponse;

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

it('throws exception for access denied', function () {
    $authentication = new EsiAuthentication('token', 'refresh_token');

    $checkAccess = mock(CheckAccess::class, function (MockInterface $mock) {
        $mock->shouldReceive('can')
            ->once()
            ->andReturnFalse();
    });

    $client = new EsiClient($authentication, $this->fetcherMock, $checkAccess);

    expect(fn () => $client->invoke('GET', '/test/uri'))->toThrow(EsiScopeAccessDeniedException::class);
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

it('creates fetcher instance', function () {
    $reflection = new ReflectionClass($this->client);
    $method = $reflection->getMethod('createFetcher');
    $method->setAccessible(true);

    $fetcher = $method->invoke($this->client);

    expect($fetcher)->toBeInstanceOf(GuzzleFetcher::class);
});
