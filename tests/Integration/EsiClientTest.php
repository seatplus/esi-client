<?php


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

it('calls public endlpoint', function () {

    $mock = new \GuzzleHttp\Handler\MockHandler([
        new Response(200, [], json_encode(['foo' => 'bar'])),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    $fetcher = new \Seatplus\EsiClient\Fetcher\GuzzleFetcher();
    $fetcher->setClient($client);

    $esi = new Seatplus\EsiClient\EsiClient();

    $esi->setVersion('v4');
    $esi->setFetcher($fetcher);

    // make a call
    $character_info = $esi->invoke('get', '/characters/{character_id}/', [
        'character_id' => 95725047,
    ]);

    expect($character_info->foo)->toBe('bar');
    expect($character_info)->toBeInstanceOf(\Seatplus\EsiClient\DataTransferObjects\EsiResponse::class);

});

it('calls endlpoint with authorization', function () {

    $mock = new \GuzzleHttp\Handler\MockHandler([
        new Response(200, [], json_encode(['foo' => 'bar'])),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    $fetcher = new \Seatplus\EsiClient\Fetcher\GuzzleFetcher();
    $fetcher->setClient($client);

    $esi = new Seatplus\EsiClient\EsiClient();

    $esi->setVersion('v4');
    $esi->setFetcher($fetcher);

    $authentication = buildEsiAuthentication();

    $esi->setAuthentication($authentication);

    // make a call
    $character_info = $esi->invoke('get', '/characters/{character_id}/', [
        'character_id' => 95725047,
    ]);

    expect($character_info->foo)->toBe('bar');
    expect($character_info)->toBeInstanceOf(\Seatplus\EsiClient\DataTransferObjects\EsiResponse::class);

});


