<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\Services;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;

class JwtService
{
    public function decodeJWT(string $jwt, array $keys): object
    {
        return JWT::decode($jwt, $keys);
    }

    public function parseJWKS(array $decodedJson): array
    {
        return JWK::parseKeySet($decodedJson);
    }
}
