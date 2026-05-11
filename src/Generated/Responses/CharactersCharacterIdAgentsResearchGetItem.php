<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdAgentsResearchGetItem
{
    public function __construct(
        public readonly int $agent_id,
        public readonly float $points_per_day,
        public readonly float $remainder_points,
        public readonly int $skill_type_id,
        public readonly string $started_at,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            agent_id: $data->agent_id,
            points_per_day: $data->points_per_day,
            remainder_points: $data->remainder_points,
            skill_type_id: $data->skill_type_id,
            started_at: $data->started_at,
        );
    }
}