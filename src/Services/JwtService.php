<?php

namespace Seatplus\EsiClient\Services;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;

class JwtService
{
    public function decodeJWT(string $jwt, array $keys, array $allowed_algs): object
    {
        return JWT::decode($jwt, $keys, $allowed_algs);
    }

    public function parseJWKS(array $decodedJson): array
    {
        return JWK::parseKeySet($decodedJson);
    }
}
