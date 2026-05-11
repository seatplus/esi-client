<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwLeaderboardsCharactersResponse
{
    public function __construct(
        public readonly GetFwLeaderboardsCharactersResponseKills $kills,
        public readonly GetFwLeaderboardsCharactersResponseVictoryPoints $victory_points,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            kills: GetFwLeaderboardsCharactersResponseKills::from($data->kills),
            victory_points: GetFwLeaderboardsCharactersResponseVictoryPoints::from($data->victory_points),
        );
    }
}