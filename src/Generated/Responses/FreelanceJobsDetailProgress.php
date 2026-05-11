<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailProgress
{
    public function __construct(
        public readonly int $current,
        public readonly int $desired,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            current: $data->current,
            desired: $data->desired,
        );
    }
}