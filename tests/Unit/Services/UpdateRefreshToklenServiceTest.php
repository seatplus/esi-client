<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use Seatplus\EsiClient\Services\UpdateRefreshTokenService;
use Seatplus\EsiClient\Services\VerifyAccessToken;

beforeEach(function () {
    $this->clientMock = mock(Client::class);
    $this->verifyAccessTokenMock = mock(VerifyAccessToken::class);
    $this->service = new UpdateRefreshTokenService($this->clientMock, $this->verifyAccessTokenMock);
});

afterEach(function () {
    Mockery::close();
});

it('returns refresh token response successfully', function () {
    $authentication = new EsiAuthentication('client_id', 'secret', 'refresh_token');
    $responseBody = json_encode([
        'access_token' => 'access_token_value',
        'expires_in' => 3600,
        'token_type' => 'Bearer',
        'refresh_token' => 'new_refresh_token',
    ]);

    $this->clientMock->shouldReceive('post')
        ->once()
        ->andReturn(new Response(200, [], $responseBody));

    $this->verifyAccessTokenMock->shouldReceive('verify')
        ->once()
        ->with('access_token_value');

    $result = $this->service->getRefreshTokenResponse($authentication);

    expect($result['access_token'])->toBe('access_token_value')
        ->and($result['refresh_token'])->toBe('new_refresh_token');
});

it('throws RequestFailedException on client error', function () {
    $authentication = new EsiAuthentication('client_id', 'secret', 'refresh_token');

    // Mock the client to throw a client exception
    $clientException = new ClientException('Client error', new \GuzzleHttp\Psr7\Request('POST', 'test'), new Response(400));

    $this->clientMock->shouldReceive('post')
        ->once()
        ->andThrow($clientException);

    expect(fn () => $this->service->getRefreshTokenResponse($authentication))
        ->toThrow(RequestFailedException::class);
});

it('throws RequestFailedException on server error', function () {
    $authentication = new EsiAuthentication('client_id', 'secret', 'refresh_token');

    // Mock the client to throw a server exception
    $serverException = new ServerException('Server error', new \GuzzleHttp\Psr7\Request('POST', 'test'), new Response(500));

    $this->clientMock->shouldReceive('post')
        ->once()
        ->andThrow($serverException);

    expect(fn () => $this->service->getRefreshTokenResponse($authentication))
        ->toThrow(RequestFailedException::class);
});
