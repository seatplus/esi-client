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
            facility_id: $data->facility_id,
            owner_id: $data->owner_id,
            region_id: $data->region_id,
            solar_system_id: $data->solar_system_id,
            type_id: $data->type_id,
            tax: $data->tax ?? null,
        );
    }
}