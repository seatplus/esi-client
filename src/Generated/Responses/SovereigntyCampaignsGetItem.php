<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class SovereigntyCampaignsGetItem
{
    public function __construct(
        public readonly int $campaign_id,
        public readonly int $constellation_id,
        public readonly string $event_type,
        public readonly int $solar_system_id,
        public readonly string $start_time,
        public readonly int $structure_id,
        public readonly ?float $attackers_score = null,
        public readonly ?int $defender_id = null,
        public readonly ?float $defender_score = null,
        public readonly ?array $participants = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            campaign_id: $data->campaign_id,
            constellation_id: $data->constellation_id,
            event_type: $data->event_type,
            solar_system_id: $data->solar_system_id,
            start_time: $data->start_time,
            structure_id: $data->structure_id,
            attackers_score: $data->attackers_score ?? null,
            defender_id: $data->defender_id ?? null,
            defender_score: $data->defender_score ?? null,
            participants: isset($data->participants) ? (array) $data->participants : null,
        );
    }
}