<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FleetsFleetIdWingsPost
{
    public function __construct(
        public readonly int $wing_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            wing_id: (int) ($data->wing_id ?? 0),
        );
    }
}