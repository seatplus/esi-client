<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdBlueprintsGetItem
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
            item_id: (int) ($data->item_id ?? 0),
            location_flag: (string) ($data->location_flag ?? ''),
            location_id: (int) ($data->location_id ?? 0),
            material_efficiency: (int) ($data->material_efficiency ?? 0),
            quantity: (int) ($data->quantity ?? 0),
            runs: (int) ($data->runs ?? 0),
            time_efficiency: (int) ($data->time_efficiency ?? 0),
            type_id: (int) ($data->type_id ?? 0),
        );
    }
}