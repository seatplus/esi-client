<?php

namespace Seatplus\EsiClient\Generated\Responses\Dogma;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetDogmaDynamicItemsTypeIdItemIdResponse
{
    public function __construct(
        public readonly int $created_by,
        public readonly array $dogma_attributes,
        public readonly array $dogma_effects,
        public readonly int $mutator_type_id,
        public readonly int $source_type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            dogma_attributes: array_map(fn(object $i) => GetDogmaDynamicItemsTypeIdItemIdResponseDogmaAttributesItem::from($i), (array) $data->dogma_attributes),
            dogma_effects: array_map(fn(object $i) => GetDogmaDynamicItemsTypeIdItemIdResponseDogmaEffectsItem::from($i), (array) $data->dogma_effects),
            created_by: $data->created_by,
            source_type_id: $data->source_type_id,
            mutator_type_id: $data->mutator_type_id,
        );
    }
}