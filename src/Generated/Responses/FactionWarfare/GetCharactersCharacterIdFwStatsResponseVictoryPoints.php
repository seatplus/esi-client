<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdFwStatsResponseVictoryPoints
{
    public function __construct(
        public readonly int $last_week,
        public readonly int $total,
        public readonly int $yesterday,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            yesterday: $data->yesterday,
            last_week: $data->last_week,
            total: $data->total,
        );
    }
}