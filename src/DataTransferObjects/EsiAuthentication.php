<?php

namespace Seatplus\EsiClient\DataTransferObjects;

use Firebase\JWT\JWT;
use Spatie\DataTransferObject\DataTransferObject;

class EsiAuthentication extends DataTransferObject
{
    public ?string $client_id;
    public ?string $secret;
    public string $access_token;
    public string $refresh_token;
    public string $token_expires = '1970-01-01 00:00:00';

    public function getScopes() : array
    {
        $jwt_payload_base64_encoded = explode('.', $this->access_token)[1];

        $jwt_payload = JWT::urlsafeB64Decode($jwt_payload_base64_encoded);

        return data_get(json_decode($jwt_payload), 'scp', []);
    }
}
