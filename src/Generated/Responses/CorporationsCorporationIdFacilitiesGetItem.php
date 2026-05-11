<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdFacilitiesGetItem
{
    public function __construct(
        public readonly int $facility_id,
        public readonly int $system_id,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            facility_id: $data->facility_id,
            system_id: $data->system_id,
            type_id: $data->type_id,
        );
    }
}