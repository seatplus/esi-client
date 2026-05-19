<?php

namespace Seatplus\EsiClient\Exceptions;

class EsiRateLimitedException extends \RuntimeException
{
    public function __construct(public readonly int $retryAfter = 60)
    {
        parent::__construct(
            "ESI rate limited (429). Retry after {$retryAfter} seconds.",
            429
        );
    }

    public function report(): false
    {
        return false;
    }
}
