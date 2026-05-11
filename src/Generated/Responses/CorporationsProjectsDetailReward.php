<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailReward
{
    public function __construct(
        public readonly float $initial,
        public readonly float $remaining,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            initial: (float) ($data->initial ?? 0.0),
            remaining: (float) ($data->remaining ?? 0.0),
        );
    }
}