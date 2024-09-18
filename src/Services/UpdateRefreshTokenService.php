<?php

namespace Seatplus\EsiClient\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\Exceptions\RequestFailedException;

class UpdateRefreshTokenService
{
    CONST TOKEN_URL = 'https://login.eveonline.com/v2/oauth/token';

    public function __construct(
        private ?Client $client = null,
        private ?VerifyAccessToken $verifyAccessToken = null
    )
    {
        $this->client = $client ?? new Client();
        $this->verifyAccessToken = $verifyAccessToken ?? new VerifyAccessToken();
    }

    /**
     * @throws RequestFailedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRefreshTokenResponse(EsiAuthentication $authentication) : array
    {
        $authorization = 'Basic '.base64_encode($authentication->client_id.':'.$authentication->secret);

        try {
            $response = $this->client->post(self::TOKEN_URL, [
                RequestOptions::HEADERS => [
                    'Authorization' => $authorization,
                ],
                RequestOptions::FORM_PARAMS => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $authentication->refresh_token,
                ],
            ]);
        } catch (ClientException | ServerException $exception) {
            // Raise the exception that should be handled by the caller
            throw new RequestFailedException(
                $exception,
                new EsiResponse(
                    $exception->getResponse()->getBody()->getContents(),
                    $exception->getResponse()->getHeaders(),
                    'now',
                    $exception->getResponse()->getStatusCode()
                )
            );
        }

        // Values are access_token // expires_in // token_type // refresh_token
        $payload = json_decode((string) $response->getBody(), true);

        $this->verifyAccessToken->verify($payload['access_token']);

        return $payload;
    }
}
