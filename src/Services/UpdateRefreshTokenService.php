<?php

namespace Seatplus\EsiClient\Services;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\Exceptions\RequestFailedException;
use UnexpectedValueException;

class UpdateRefreshTokenService
{

    /**
     * Tranquility endpoint for retrieving user info.
     */
    public const TRANQUILITY_ENDPOINT = 'https://login.eveonline.com';
    private Client $client;

    /**
     * @throws RequestFailedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRefreshTokenResponse(EsiAuthentication $authentication) : array
    {
        $authorization = 'Basic '.base64_encode($authentication->client_id.':'.$authentication->secret);

        try {
            $response = $this->getClient()->post($this->getTokenUrl(), [
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

        $this->verify($payload['access_token']);

        return $payload;
    }

    protected function getTokenUrl()
    {
        return 'https://login.eveonline.com/v2/oauth/token';
    }

    private function verify($jwt)
    {
        $responseJwks = $this->client->get('https://login.eveonline.com/oauth/jwks');
        $responseJwksInfo = json_decode((string) $responseJwks->getBody(), true);
        $decodedArray = (array) JWT::decode($jwt, JWK::parseKeySet($responseJwksInfo), ['RS256']);

        if ($decodedArray['iss'] !== 'login.eveonline.com' && $decodedArray['iss'] !== self::TRANQUILITY_ENDPOINT) {
            throw new UnexpectedValueException('Access token issuer mismatch');
        }

        if (time() >= $decodedArray['exp']) {
            throw new ExpiredException();
        }

        return $decodedArray;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if (! isset($this->client)) {
            $this->setClient(new Client());
        }

        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
