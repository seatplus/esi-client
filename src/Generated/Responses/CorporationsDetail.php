<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsDetail
{
    public function __construct(
        public readonly int $ceo_id,
        public readonly int $creator_id,
        public readonly int $member_count,
        public readonly string $name,
        public readonly float $tax_rate,
        public readonly string $ticker,
        public readonly ?int $alliance_id = null,
        public readonly ?string $date_founded = null,
        public readonly ?string $description = null,
        public readonly ?int $faction_id = null,
        public readonly ?int $home_station_id = null,
        public readonly ?int $shares = null,
        public readonly ?string $url = null,
        public readonly ?bool $war_eligible = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            ceo_id: (int) ($data->ceo_id ?? 0),
            creator_id: (int) ($data->creator_id ?? 0),
            member_count: (int) ($data->member_count ?? 0),
            name: (string) ($data->name ?? ''),
            tax_rate: (float) ($data->tax_rate ?? 0.0),
            ticker: (string) ($data->ticker ?? ''),
            alliance_id: $data->alliance_id ?? null,
            date_founded: $data->date_founded ?? null,
            description: $data->description ?? null,
            faction_id: $data->faction_id ?? null,
            home_station_id: $data->home_station_id ?? null,
            shares: $data->shares ?? null,
            url: $data->url ?? null,
            war_eligible: $data->war_eligible ?? null,
        );
    }
}