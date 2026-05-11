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
            against_id: (int) ($data->against_id ?? 0),
            faction_id: (int) ($data->faction_id ?? 0),
        );
    }
}