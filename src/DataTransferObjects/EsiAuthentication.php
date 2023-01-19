<?php

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
    ) {
    }

    public function getScopes() : array
    {
        $jwt_payload_base64_encoded = explode('.', $this->access_token)[1];

        $jwt_payload = JWT::urlsafeB64Decode($jwt_payload_base64_encoded);

        $scopes = data_get(json_decode($jwt_payload), 'scp', []);

        return is_array($scopes) ? $scopes : [$scopes];
    }
}
