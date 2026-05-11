<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwLeaderboardsCorporationsResponse
{
    public function __construct(
        public readonly GetFwLeaderboardsCorporationsResponseKills $kills,
        public readonly GetFwLeaderboardsCorporationsResponseVictoryPoints $victory_points,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            kills: GetFwLeaderboardsCorporationsResponseKills::from($data->kills),
            victory_points: GetFwLeaderboardsCorporationsResponseVictoryPoints::from($data->victory_points),
        );
    }
}