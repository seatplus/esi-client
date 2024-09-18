<?php

namespace Seatplus\EsiClient\Services;

use GuzzleHttp\Client;
use UnexpectedValueException;
use Firebase\JWT\ExpiredException;

class VerifyAccessToken
{
    CONST JWKS_URL = 'https://login.eveonline.com/oauth/jwks';
    CONST TRANQUILITY_ENDPOINT = 'https://login.eveonline.com';

    public function __construct(
        private ?Client $client = null,
        private ?JwtService $jwtService = null
    )
    {
        $this->client = $client ?? new Client();
        $this->jwtService = $jwtService ?? new JwtService();
    }

    public function verify(string $access_token): void
    {
        $response = $this->client->get(self::JWKS_URL);
        $decodedJson = json_decode((string) $response->getBody(), true);
        $parsedKeySet = $this->jwtService->parseJWKS($decodedJson);


        $decodedArray = (array) $this->jwtService->decodeJWT($access_token, $parsedKeySet, ['RS256']);

        if ($decodedArray['iss'] !== 'login.eveonline.com' && $decodedArray['iss'] !== self::TRANQUILITY_ENDPOINT) {
            throw new UnexpectedValueException('Access token issuer mismatch');
        }

        if (time() >= $decodedArray['exp']) {
            throw new ExpiredException();
        }
    }
}
