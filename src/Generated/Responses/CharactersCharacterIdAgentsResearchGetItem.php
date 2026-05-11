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
            agent_id: (int) ($data->agent_id ?? 0),
            points_per_day: (float) ($data->points_per_day ?? 0.0),
            remainder_points: (float) ($data->remainder_points ?? 0.0),
            skill_type_id: (int) ($data->skill_type_id ?? 0),
            started_at: (string) ($data->started_at ?? ''),
        );
    }
}