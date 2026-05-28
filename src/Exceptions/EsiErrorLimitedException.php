<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\Exceptions;

class EsiErrorLimitedException extends \RuntimeException
{
    public function __construct(public readonly int $retryAfter = 60)
    {
        parent::__construct(
            "ESI error limited (420). Retry after {$retryAfter} seconds.",
            420
        );
    }
}
