<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdAssetsGetItem
{
    public function __construct(
        public readonly bool $is_singleton,
        public readonly int $item_id,
        public readonly string $location_flag,
        public readonly int $location_id,
        public readonly string $location_type,
        public readonly int $quantity,
        public readonly int $type_id,
        public readonly ?bool $is_blueprint_copy = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            is_singleton: (bool) ($data->is_singleton ?? false),
            item_id: (int) ($data->item_id ?? 0),
            location_flag: (string) ($data->location_flag ?? ''),
            location_id: (int) ($data->location_id ?? 0),
            location_type: (string) ($data->location_type ?? ''),
            quantity: (int) ($data->quantity ?? 0),
            type_id: (int) ($data->type_id ?? 0),
            is_blueprint_copy: $data->is_blueprint_copy ?? null,
        );
    }
}