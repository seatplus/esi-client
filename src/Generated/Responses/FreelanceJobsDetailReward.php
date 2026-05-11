<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailReward
{
    public function __construct(
        public readonly float $initial,
        public readonly float $remaining,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            initial: $data->initial,
            remaining: $data->remaining,
        );
    }
}