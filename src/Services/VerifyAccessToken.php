<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\Services;

use Firebase\JWT\ExpiredException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Seatplus\EsiClient\Exceptions\EsiTransportException;
use UnexpectedValueException;

class VerifyAccessToken
{
    const string JWKS_URL = 'https://login.eveonline.com/oauth/jwks';

    const string TRANQUILITY_ENDPOINT = 'https://login.eveonline.com';

    public function __construct(private readonly Client $client = new Client, private readonly JwtService $jwtService = new JwtService) {}

    /**
     * @throws EsiTransportException
     * @throws UnexpectedValueException
     * @throws ExpiredException
     */
    public function verify(string $accessToken): void
    {
        try {
            $response = $this->client->get(self::JWKS_URL);
        } catch (GuzzleException $exception) {
            throw new EsiTransportException(
                'Request to '.self::JWKS_URL." failed: {$exception->getMessage()}",
                previous: $exception
            );
        }

        $decodedJson = json_decode((string) $response->getBody(), true);
        $parsedKeySet = $this->jwtService->parseJWKS($decodedJson);

        $decodedArray = (array) $this->jwtService->decodeJWT($accessToken, $parsedKeySet);

        if ($decodedArray['iss'] !== 'login.eveonline.com' && $decodedArray['iss'] !== self::TRANQUILITY_ENDPOINT) {
            throw new UnexpectedValueException('Access token issuer mismatch');
        }

        if (time() >= $decodedArray['exp']) {
            throw new ExpiredException;
        }
    }
}
