<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdFwStatsGet
{
    public function __construct(
        public readonly mixed $kills,
        public readonly mixed $victory_points,
        public readonly ?int $current_rank = null,
        public readonly ?string $enlisted_on = null,
        public readonly ?int $faction_id = null,
        public readonly ?int $highest_rank = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            kills: ($data->kills ?? null),
            victory_points: ($data->victory_points ?? null),
            current_rank: $data->current_rank ?? null,
            enlisted_on: $data->enlisted_on ?? null,
            faction_id: $data->faction_id ?? null,
            highest_rank: $data->highest_rank ?? null,
        );
    }
}