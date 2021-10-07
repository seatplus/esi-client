<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

beforeEach(fn () => $this->fetcher = new \Seatplus\EsiClient\Fetcher\GuzzleFetcher);

test('guzzle calling without authorization', function () {
    $mock = new \GuzzleHttp\Handler\MockHandler([
        new Response(200, [], json_encode(['foo' => 'bar'])),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    $response = $this->fetcher->setClient($client)->call('get', '/foo');

    expect($response)->toBeInstanceOf(\Seatplus\EsiClient\DataTransferObjects\EsiResponse::class);
});

test('guzzle calling with authorization', function () {
    $mock = new \GuzzleHttp\Handler\MockHandler([
        new Response(200, [], json_encode(['foo' => 'bar'])),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    // Mock RefreshToken
    $refresh_token_service = Mockery::mock(\Seatplus\EsiClient\Services\UpdateRefreshTokenService::class);
    $refresh_token_service->shouldReceive('getRefreshTokenResponse')->once()->andReturn([
        'access_token' => 'foo', 'expires_in' => 1200, 'refresh_token' => 'bar',
    ]);

    $authentication = new \Seatplus\EsiClient\DataTransferObjects\EsiAuthentication([
        // ESI client_id and secret specific
        'client_id' => 1234,
        'secret' => 'bar',
        // refresh_token specific
        'access_token' => '_',
        'refresh_token' => 'baz',
        'token_expires' => '1970-01-01 00:00:00',
        'scopes' => ['public'],
    ]);

    $fetcher = new \Seatplus\EsiClient\Fetcher\GuzzleFetcher(null, $refresh_token_service);

    $response = $fetcher
        ->setClient($client)
        ->setAuthentication($authentication)->call('get', '/foo');

    expect($response)->toBeInstanceOf(\Seatplus\EsiClient\DataTransferObjects\EsiResponse::class);
});

it('trows RequestFailedException', function () {
    $mock = new \GuzzleHttp\Handler\MockHandler([
        new Response(401, ['foo' => 'bar'], 'test'),
    ]);

    $this->fetcher
        ->setClient(new Client([
            'handler' => HandlerStack::create($mock),
            ]))
        ->call('get', '/foo');
})->throws(\Seatplus\EsiClient\Exceptions\RequestFailedException::class);
