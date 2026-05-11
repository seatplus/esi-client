<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseSystemJumpsItem
{
    public function __construct(
        public readonly int $ship_jumps,
        public readonly int $system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            system_id: $data->system_id,
            ship_jumps: $data->ship_jumps,
        );
    }
}