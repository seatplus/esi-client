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
            ship_jumps: (int) ($data->ship_jumps ?? 0),
            system_id: (int) ($data->system_id ?? 0),
        );
    }
}