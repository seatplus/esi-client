<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

it('updates access token with refresh token', function () {
    $jwt_token = json_encode([
        "scp" => [
            "esi-skills.read_skills.v1",
            "esi-skills.read_skillqueue.v1",
        ],
        "jti" => "998e12c7-3241-43c5-8355-2c48822e0a1b",
        "kid" => "JWT-Signature-Key",
        "sub" => "CHARACTER:EVE:123123",
        "azp" => "my3rdpartyclientid",
        "name" => "Some Bloke",
        "owner" => "8PmzCeTKb4VFUDrHLc/AeZXDSWM=",
        "exp" => 1534412504,
        "iss" => "login.eveonline.com",
    ]);

    $authentication = buildEsiAuthentication([
        'access_token' => $jwt_token,
    ]);

    $mock = new \GuzzleHttp\Handler\MockHandler([
        new Response(200, [], json_encode(['access_token' => 'bar'])),
        new Response(200, [], json_encode(['jwks' => ['one', 'two', 'three']])),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    // mock JWT
    $jwt_mock = Mockery::mock('overload:' . \Firebase\JWT\JWT::class);
    $jwt_mock->shouldReceive('decode')->once()->andReturn([
        "iss" => "login.eveonline.com",
        "exp" => now()->addHour()->timestamp,
    ]);

    $jwk_mock = Mockery::mock('overload:' . \Firebase\JWT\JWK::class);
    $jwk_mock->shouldReceive('parseKeySet')->once()->andReturn([]);

    $service = new \Seatplus\EsiClient\Services\RefreshToken($authentication, $client);

    $response = $service->getRefreshTokenResponse();

    expect($response)->toBe(['access_token' => 'bar']);
});
