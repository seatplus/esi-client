<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwStatsItem
{
    public function __construct(
        public readonly int $faction_id,
        public readonly GetFwStatsItemKills $kills,
        public readonly int $pilots,
        public readonly int $systems_controlled,
        public readonly GetFwStatsItemVictoryPoints $victory_points,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            faction_id: $data->faction_id,
            pilots: $data->pilots,
            systems_controlled: $data->systems_controlled,
            kills: GetFwStatsItemKills::from($data->kills),
            victory_points: GetFwStatsItemVictoryPoints::from($data->victory_points),
        );
    }
}