<?php

use Firebase\JWT\ExpiredException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Seatplus\EsiClient\Services\JwtService;
use Seatplus\EsiClient\Services\VerifyAccessToken;

beforeEach(function () {
    $this->clientMock = mock(Client::class);
    $this->jwtServiceMock = mock(JwtService::class);
    $this->service = new VerifyAccessToken($this->clientMock, $this->jwtServiceMock);
});

afterEach(function () {
    Mockery::close();
});

it('verifies access token successfully', function () {
    $accessToken = 'valid_access_token';
    $jwksResponse = json_encode(['keys' => []]);
    $decodedToken = (object) ['iss' => 'login.eveonline.com', 'exp' => time() + 3600];

    $this->clientMock->shouldReceive('get')
        ->once()
        ->with(VerifyAccessToken::JWKS_URL)
        ->andReturn(new Response(200, [], $jwksResponse));

    $this->jwtServiceMock->shouldReceive('parseJWKS')
        ->once()
        ->with(json_decode($jwksResponse, true))
        ->andReturn([]);

    $this->jwtServiceMock->shouldReceive('decodeJWT')
        ->once()
        ->with($accessToken, [])
        ->andReturn($decodedToken);

    $this->service->verify($accessToken);
});

it('throws UnexpectedValueException on access token issuer mismatch', function () {
    $accessToken = 'invalid_issuer_token';
    $jwksResponse = json_encode(['keys' => []]);
    $decodedToken = (object) ['iss' => 'invalid_issuer', 'exp' => time() + 3600];

    $this->clientMock->shouldReceive('get')
        ->once()
        ->with(VerifyAccessToken::JWKS_URL)
        ->andReturn(new Response(200, [], $jwksResponse));

    $this->jwtServiceMock->shouldReceive('parseJWKS')
        ->once()
        ->with(json_decode($jwksResponse, true))
        ->andReturn([]);

    $this->jwtServiceMock->shouldReceive('decodeJWT')
        ->once()
        ->with($accessToken, [])
        ->andReturn($decodedToken);

    expect(fn () => $this->service->verify($accessToken))
        ->toThrow(UnexpectedValueException::class, 'Access token issuer mismatch');
});

it('throws ExpiredException on expired access token', function () {
    $accessToken = 'expired_access_token';
    $jwksResponse = json_encode(['keys' => []]);
    $decodedToken = (object) ['iss' => 'login.eveonline.com', 'exp' => time() - 3600];

    $this->clientMock->shouldReceive('get')
        ->once()
        ->with(VerifyAccessToken::JWKS_URL)
        ->andReturn(new Response(200, [], $jwksResponse));

    $this->jwtServiceMock->shouldReceive('parseJWKS')
        ->once()
        ->with(json_decode($jwksResponse, true))
        ->andReturn([]);

    $this->jwtServiceMock->shouldReceive('decodeJWT')
        ->once()
        ->with($accessToken, [])
        ->andReturn($decodedToken);

    expect(fn () => $this->service->verify($accessToken))
        ->toThrow(ExpiredException::class);
});
