<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdFwStatsGet
{
    public function __construct(
        public readonly mixed $kills,
        public readonly mixed $victory_points,
        public readonly ?string $enlisted_on = null,
        public readonly ?int $faction_id = null,
        public readonly ?int $pilots = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            kills: ($data->kills ?? null),
            victory_points: ($data->victory_points ?? null),
            enlisted_on: $data->enlisted_on ?? null,
            faction_id: $data->faction_id ?? null,
            pilots: $data->pilots ?? null,
        );
    }
}