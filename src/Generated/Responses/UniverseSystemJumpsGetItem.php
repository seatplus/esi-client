<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseSystemJumpsGetItem
{
    public function __construct(
        public readonly int $ship_jumps,
        public readonly int $system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            ship_jumps: $data->ship_jumps,
            system_id: $data->system_id,
        );
    }
}