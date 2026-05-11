<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdFwStatsResponse
{
    public function __construct(
        public readonly GetCorporationsCorporationIdFwStatsResponseKills $kills,
        public readonly GetCorporationsCorporationIdFwStatsResponseVictoryPoints $victory_points,
        public readonly ?string $enlisted_on = null,
        public readonly ?int $faction_id = null,
        public readonly ?int $pilots = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            kills: GetCorporationsCorporationIdFwStatsResponseKills::from($data->kills),
            victory_points: GetCorporationsCorporationIdFwStatsResponseVictoryPoints::from($data->victory_points),
            enlisted_on: $data->enlisted_on ?? null,
            faction_id: $data->faction_id ?? null,
            pilots: $data->pilots ?? null,
        );
    }
}