<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdCustomsOfficesGetItem
{
    public function __construct(
        public readonly bool $allow_access_with_standings,
        public readonly bool $allow_alliance_access,
        public readonly int $office_id,
        public readonly int $reinforce_exit_end,
        public readonly int $reinforce_exit_start,
        public readonly int $system_id,
        public readonly ?float $alliance_tax_rate = null,
        public readonly ?float $bad_standing_tax_rate = null,
        public readonly ?float $corporation_tax_rate = null,
        public readonly ?float $excellent_standing_tax_rate = null,
        public readonly ?float $good_standing_tax_rate = null,
        public readonly ?float $neutral_standing_tax_rate = null,
        public readonly ?string $standing_level = null,
        public readonly ?float $terrible_standing_tax_rate = null,
        public readonly ?int $type_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            allow_access_with_standings: $data->allow_access_with_standings,
            allow_alliance_access: $data->allow_alliance_access,
            office_id: $data->office_id,
            reinforce_exit_end: $data->reinforce_exit_end,
            reinforce_exit_start: $data->reinforce_exit_start,
            system_id: $data->system_id,
            alliance_tax_rate: $data->alliance_tax_rate ?? null,
            bad_standing_tax_rate: $data->bad_standing_tax_rate ?? null,
            corporation_tax_rate: $data->corporation_tax_rate ?? null,
            excellent_standing_tax_rate: $data->excellent_standing_tax_rate ?? null,
            good_standing_tax_rate: $data->good_standing_tax_rate ?? null,
            neutral_standing_tax_rate: $data->neutral_standing_tax_rate ?? null,
            standing_level: $data->standing_level ?? null,
            terrible_standing_tax_rate: $data->terrible_standing_tax_rate ?? null,
            type_id: $data->type_id ?? null,
        );
    }
}