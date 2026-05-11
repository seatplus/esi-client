<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwLeaderboardsResponse
{
    public function __construct(
        public readonly GetFwLeaderboardsResponseKills $kills,
        public readonly GetFwLeaderboardsResponseVictoryPoints $victory_points,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            kills: GetFwLeaderboardsResponseKills::from($data->kills),
            victory_points: GetFwLeaderboardsResponseVictoryPoints::from($data->victory_points),
        );
    }
}