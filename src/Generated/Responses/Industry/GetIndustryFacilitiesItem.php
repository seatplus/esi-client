<?php

namespace Seatplus\EsiClient\Generated\Responses\Industry;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetIndustryFacilitiesItem
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
            type_id: $data->type_id,
            solar_system_id: $data->solar_system_id,
            region_id: $data->region_id,
            tax: $data->tax ?? null,
        );
    }
}