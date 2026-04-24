<?php

namespace Seatplus\EsiClient\Services;

use Firebase\JWT\ExpiredException;
use GuzzleHttp\Client;
use UnexpectedValueException;

class VerifyAccessToken
{
    const JWKS_URL = 'https://login.eveonline.com/oauth/jwks';

    const TRANQUILITY_ENDPOINT = 'https://login.eveonline.com';

    public function __construct(private readonly Client $client = new Client, private readonly JwtService $jwtService = new JwtService) {}

    public function verify(string $access_token): void
    {
        $response = $this->client->get(self::JWKS_URL);
        $decodedJson = json_decode((string) $response->getBody(), true);
        $parsedKeySet = $this->jwtService->parseJWKS($decodedJson);

        $decodedArray = (array) $this->jwtService->decodeJWT($access_token, $parsedKeySet);

        if ($decodedArray['iss'] !== 'login.eveonline.com' && $decodedArray['iss'] !== self::TRANQUILITY_ENDPOINT) {
            throw new UnexpectedValueException('Access token issuer mismatch');
        }

        if (time() >= $decodedArray['exp']) {
            throw new ExpiredException;
        }
    }
}
