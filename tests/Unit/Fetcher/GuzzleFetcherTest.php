<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Seatplus\EsiClient\Exceptions\ExpiredRefreshTokenException;

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

    $authentication = new \Seatplus\EsiClient\DataTransferObjects\EsiAuthentication(
        // ESI client_id and secret specific
        access_token: '_',
        refresh_token: 'baz',
        // refresh_token specific
        client_id: 1234,
        secret: 'bar',
        token_expires: now()->addHour(),
    );

    $fetcher = new \Seatplus\EsiClient\Fetcher\GuzzleFetcher();

    $response = $fetcher
        ->setClient($client)
        ->setAuthentication($authentication)->call('get', '/foo');

    expect($response)->toBeInstanceOf(\Seatplus\EsiClient\DataTransferObjects\EsiResponse::class);
});

it('throws outdated refresh_token excpetion if expires_in is expired or to close in the future', function ($token_expires) {
    $authentication = new \Seatplus\EsiClient\DataTransferObjects\EsiAuthentication(
        // ESI client_id and secret specific
        access_token: '_',
        refresh_token: 'baz',
        // refresh_token specific
        client_id: 1234,
        secret: 'bar',
        token_expires: $token_expires,
    );

    $fetcher = new \Seatplus\EsiClient\Fetcher\GuzzleFetcher();

    $fetcher->setAuthentication($authentication)->call('get', '/foo');
})->with(['1970-01-01 00:00:00', now()->addSeconds(50)->toDateTimeString()])
    ->throws(ExpiredRefreshTokenException::class);

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
