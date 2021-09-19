<?php

namespace Seatplus\EsiClient\Services;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use UnexpectedValueException;

class RefreshToken
{

    /**
     * Tranquility endpoint for retrieving user info.
     */
    public const TRANQUILITY_ENDPOINT = 'https://login.eveonline.com';

    public function __construct(protected EsiAuthentication $authentication, private Client $client)
    {
    }

    public function getRefreshTokenResponse() : array
    {
        $authorization = 'Basic '.base64_encode($this->authentication->client_id.':'.$this->authentication->secret);

        $response = $this->client->post($this->getTokenUrl(), [
            RequestOptions::HEADERS => [
                'Authorization' => $authorization,
            ],
            RequestOptions::FORM_PARAMS => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->authentication->refresh_token,
            ],
        ]);

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
}
