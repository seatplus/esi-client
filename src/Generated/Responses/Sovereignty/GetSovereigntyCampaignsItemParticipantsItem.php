<?php

namespace Seatplus\EsiClient\Generated\Responses\Sovereignty;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetSovereigntyCampaignsItemParticipantsItem
{
    public function __construct(
        public readonly int $alliance_id,
        public readonly float $score,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            alliance_id: $data->alliance_id,
            score: $data->score,
        );
    }
}