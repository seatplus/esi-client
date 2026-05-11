<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdFwStatsResponse
{
    public function __construct(
        public readonly GetCharactersCharacterIdFwStatsResponseKills $kills,
        public readonly GetCharactersCharacterIdFwStatsResponseVictoryPoints $victory_points,
        public readonly ?int $current_rank = null,
        public readonly ?string $enlisted_on = null,
        public readonly ?int $faction_id = null,
        public readonly ?int $highest_rank = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            kills: GetCharactersCharacterIdFwStatsResponseKills::from($data->kills),
            victory_points: GetCharactersCharacterIdFwStatsResponseVictoryPoints::from($data->victory_points),
            current_rank: $data->current_rank ?? null,
            enlisted_on: $data->enlisted_on ?? null,
            faction_id: $data->faction_id ?? null,
            highest_rank: $data->highest_rank ?? null,
        );
    }
}