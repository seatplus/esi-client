<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailBroadcastlocations
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            id: $data->id,
            name: $data->name,
        );
    }
}