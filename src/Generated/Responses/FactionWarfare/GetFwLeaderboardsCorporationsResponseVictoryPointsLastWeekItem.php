<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwLeaderboardsCorporationsResponseVictoryPointsLastWeekItem
{
    public function __construct(
        public readonly ?int $amount = null,
        public readonly ?int $corporation_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            amount: $data->amount ?? null,
            corporation_id: $data->corporation_id ?? null,
        );
    }
}