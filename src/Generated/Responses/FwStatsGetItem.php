<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FwStatsGetItem
{
    public function __construct(
        public readonly int $faction_id,
        public readonly mixed $kills,
        public readonly int $pilots,
        public readonly int $systems_controlled,
        public readonly mixed $victory_points,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            faction_id: (int) ($data->faction_id ?? 0),
            kills: ($data->kills ?? null),
            pilots: (int) ($data->pilots ?? 0),
            systems_controlled: (int) ($data->systems_controlled ?? 0),
            victory_points: ($data->victory_points ?? null),
        );
    }
}