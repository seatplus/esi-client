<?php

use Carbon\Carbon;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use Seatplus\EsiClient\Services\UpdateRefreshTokenService;
use Seatplus\EsiClient\Services\VerifyAccessToken;

/** @runInSeparateProcess  */
it('updates access token with refresh token', function () {
    // create a private key for signing the JWT Token
    $privKey = openssl_pkey_new(['digest_alg' => 'sha256',
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA, ]);

    // define the payload
    $payload = [
        'scp' => [
            'esi-skills.read_skills.v1',
            'esi-skills.read_skillqueue.v1',
        ],
        'jti' => '998e12c7-3241-43c5-8355-2c48822e0a1b',
        'kid' => 'JWT-Signature-Key',
        'sub' => 'CHARACTER:EVE:123123',
        'azp' => 'my3rdpartyclientid',
        'name' => 'Some Bloke',
        'owner' => '8PmzCeTKb4VFUDrHLc/AeZXDSWM=',
        'exp' => Carbon::now()->addHour()->timestamp,
        'iss' => 'login.eveonline.com',
    ];

    // encode the jwt token
    $jwt_token = JWT::encode($payload, $privKey, 'RS256');

    // build the authentication container
    $authentication = buildEsiAuthentication([
        'access_token' => $jwt_token,
    ]);

    // create the client mock and responses from said client
    $mock = new MockHandler([
        new Response(200, [], json_encode(['access_token' => $jwt_token, 'foo' => 'bar'])),
        new Response(200, [], json_encode(['jwks' => ['one', 'two', 'three']])),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    // mock the verifyAccessToken service
    $verifyAccessToken = mock(VerifyAccessToken::class, function ($mock) use ($jwt_token) {
        $mock->shouldReceive('verify')->once()->with($jwt_token);
    });

    // construct the service
    $service = new UpdateRefreshTokenService($client, $verifyAccessToken);

    // use service to get the refresh Token
    $response = $service->getRefreshTokenResponse($authentication);

    // assert the expected result. See the mocked response as reference
    expect($response)
        ->toBeArray()
        ->toHaveKey('access_token', $jwt_token)
        ->toHaveKey('foo', 'bar');
});

it('throws RequestFailedException if an exception occurs', function () {
    // create the client mock and responses from said client
    $mock = new MockHandler([
        new Response(400, [], 'Error'),
    ]);

    $client = new Client([
        'handler' => HandlerStack::create($mock),
    ]);

    // construct the service
    $service = new UpdateRefreshTokenService($client);

    $service->getRefreshTokenResponse(buildEsiAuthentication());
})->throws(RequestFailedException::class);
