<?php

namespace Seatplus\EsiClient\Log;

class NullLogger implements LogInterface
{
    public function log(string $message): void
    {
    }

    public function debug(string $message): void
    {
    }

    public function warning(string $message): void
    {
    }

    public function error(string $message): void
    {
    }
}
