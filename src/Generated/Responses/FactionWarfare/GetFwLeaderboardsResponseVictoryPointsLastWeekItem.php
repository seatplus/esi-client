<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwLeaderboardsResponseVictoryPointsLastWeekItem
{
    public function __construct(
        public readonly ?int $amount = null,
        public readonly ?int $faction_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            amount: $data->amount ?? null,
            faction_id: $data->faction_id ?? null,
        );
    }
}