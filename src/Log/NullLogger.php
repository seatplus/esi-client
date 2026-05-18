<?php

namespace Seatplus\EsiClient\Log;

class NullLogger implements LogInterface
{
    #[\Override]
    public function log(string $message): void {}

    #[\Override]
    public function debug(string $message): void {}

    #[\Override]
    public function warning(string $message): void {}

    #[\Override]
    public function error(string $message): void {}
}
