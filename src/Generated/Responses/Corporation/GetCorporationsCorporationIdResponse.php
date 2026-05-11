<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdResponse
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
            name: $data->name,
            ticker: $data->ticker,
            member_count: $data->member_count,
            ceo_id: $data->ceo_id,
            tax_rate: $data->tax_rate,
            creator_id: $data->creator_id,
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