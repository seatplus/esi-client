<?php

namespace Seatplus\EsiClient\Generated\Responses\Assets;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdAssetsItem
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
            type_id: $data->type_id,
            quantity: $data->quantity,
            location_id: $data->location_id,
            location_type: $data->location_type,
            item_id: $data->item_id,
            location_flag: $data->location_flag,
            is_singleton: $data->is_singleton,
            is_blueprint_copy: $data->is_blueprint_copy ?? null,
        );
    }
}