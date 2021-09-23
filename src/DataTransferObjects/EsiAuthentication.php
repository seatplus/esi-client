<?php

namespace Seatplus\EsiClient\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class EsiAuthentication extends DataTransferObject
{
    public int $client_id;
    public string $secret;
    public string $access_token;
    public string $refresh_token;
    public string $token_expires = '1970-01-01 00:00:00';

    public function getScopes() : array
    {
        $jwt = json_decode($this->access_token);

        return $jwt->scp ?? [];
    }
}
