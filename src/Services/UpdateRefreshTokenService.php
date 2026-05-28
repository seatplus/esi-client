<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\Exceptions\RequestFailedException;

class UpdateRefreshTokenService
{
    const string TOKEN_URL = 'https://login.eveonline.com/v2/oauth/token';

    public function __construct(
        private readonly Client $client = new Client,
        private readonly VerifyAccessToken $verifyAccessToken = new VerifyAccessToken,
    ) {}

    /**
     * @throws RequestFailedException
     * @throws GuzzleException
     */
    public function getRefreshTokenResponse(EsiAuthentication $authentication): array
    {
        $credentials = base64_encode("{$authentication->client_id}:{$authentication->secret}");
        $authorization = "Basic {$credentials}";

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
        } catch (ClientException|ServerException $exception) {
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

        $payload = json_decode((string) $response->getBody(), true);

        $this->verifyAccessToken->verify($payload['access_token']);

        return $payload;
    }
}
