<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\DataTransferObjects;

use Firebase\JWT\JWT;

class EsiAuthentication
{
    public function __construct(
        public string $access_token,
        public string $refresh_token,
        public ?string $client_id = null,
        public ?string $secret = null,
        public string $token_expires = '1970-01-01 00:00:00',
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
        $jwt_payload_base64_encoded = explode('.', $this->access_token)[1];

        $jwt_payload = JWT::urlsafeB64Decode($jwt_payload_base64_encoded);

        $scopes = data_get(json_decode($jwt_payload), 'scp', []);

        return is_array($scopes) ? $scopes : [$scopes];
    }
}
