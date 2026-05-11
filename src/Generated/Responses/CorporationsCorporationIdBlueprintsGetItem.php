<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdBlueprintsGetItem
{
    public function __construct(
        public readonly int $item_id,
        public readonly string $location_flag,
        public readonly int $location_id,
        public readonly int $material_efficiency,
        public readonly int $quantity,
        public readonly int $runs,
        public readonly int $time_efficiency,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            item_id: $data->item_id,
            location_flag: $data->location_flag,
            location_id: $data->location_id,
            material_efficiency: $data->material_efficiency,
            quantity: $data->quantity,
            runs: $data->runs,
            time_efficiency: $data->time_efficiency,
            type_id: $data->type_id,
        );
    }
}