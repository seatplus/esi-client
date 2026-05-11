<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class IndustryFacilitiesGetItem
{
    public function __construct(
        public readonly int $facility_id,
        public readonly int $owner_id,
        public readonly int $region_id,
        public readonly int $solar_system_id,
        public readonly int $type_id,
        public readonly ?float $tax = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            facility_id: (int) ($data->facility_id ?? 0),
            owner_id: (int) ($data->owner_id ?? 0),
            region_id: (int) ($data->region_id ?? 0),
            solar_system_id: (int) ($data->solar_system_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
            tax: $data->tax ?? null,
        );
    }
}