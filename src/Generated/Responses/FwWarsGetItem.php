<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FwWarsGetItem
{
    public function __construct(
        public readonly int $against_id,
        public readonly int $faction_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            against_id: $data->against_id,
            faction_id: $data->faction_id,
        );
    }
}