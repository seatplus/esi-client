<?php

namespace Seatplus\EsiClient\Exceptions;

use Seatplus\EsiClient\Services\UpdateRefreshTokenService;

class ExpiredRefreshTokenException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The given refresh_token is already or will be expiring within the next minute. '
            . 'Please refresh the token and try again. EsiClient offers a service: ' . UpdateRefreshTokenService::class . ' to do so.', 422);
    }
}
