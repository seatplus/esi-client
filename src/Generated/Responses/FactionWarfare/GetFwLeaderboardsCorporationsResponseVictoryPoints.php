<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwLeaderboardsCorporationsResponseVictoryPoints
{
    public function __construct(
        public readonly array $active_total,
        public readonly array $last_week,
        public readonly array $yesterday,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            yesterday: array_map(fn(object $i) => GetFwLeaderboardsCorporationsResponseVictoryPointsYesterdayItem::from($i), (array) $data->yesterday),
            last_week: array_map(fn(object $i) => GetFwLeaderboardsCorporationsResponseVictoryPointsLastWeekItem::from($i), (array) $data->last_week),
            active_total: array_map(fn(object $i) => GetFwLeaderboardsCorporationsResponseVictoryPointsActiveTotalItem::from($i), (array) $data->active_total),
        );
    }
}