<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\DataTransferObjects;

use Firebase\JWT\JWT;

class EsiAuthentication
{
    public function __construct(
        public string $accessToken,
        public string $refreshToken,
        public ?string $clientId = null,
        public ?string $secret = null,
        public string $tokenExpires = '1970-01-01 00:00:00',
    ) {}

    /**
     * Derive the access token's real expiry from its JWT `exp` claim.
     *
     * An access token supplied via EsiClient::withToken() has no separately-provided
     * expiry; without this it falls back to the 1970 default and every request is
     * wrongly rejected as expiring. The JWT itself is the source of truth.
     */
    public static function expiresFromToken(string $accessToken): string
    {
        $parts = explode('.', $accessToken);

        if (count($parts) < 2) {
            return '1970-01-01 00:00:00';
        }

        $payload = json_decode(JWT::urlsafeB64Decode($parts[1]));
        $exp = data_get($payload, 'exp');

        return $exp ? date('Y-m-d H:i:s', (int) $exp) : '1970-01-01 00:00:00';
    }

    public function getScopes(): array
    {
        $jwtPayloadBase64Encoded = explode('.', $this->accessToken)[1];

        $jwtPayload = JWT::urlsafeB64Decode($jwtPayloadBase64Encoded);

        $scopes = data_get(json_decode($jwtPayload), 'scp', []);

        return is_array($scopes) ? $scopes : [$scopes];
    }
}
