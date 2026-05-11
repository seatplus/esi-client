<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseTypesTypeIdResponse
{
    public function __construct(
        public readonly string $description,
        public readonly int $group_id,
        public readonly string $name,
        public readonly bool $published,
        public readonly int $type_id,
        public readonly ?float $capacity = null,
        public readonly ?array $dogma_attributes = null,
        public readonly ?array $dogma_effects = null,
        public readonly ?int $graphic_id = null,
        public readonly ?int $icon_id = null,
        public readonly ?int $market_group_id = null,
        public readonly ?float $mass = null,
        public readonly ?float $packaged_volume = null,
        public readonly ?int $portion_size = null,
        public readonly ?float $radius = null,
        public readonly ?float $volume = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            type_id: $data->type_id,
            name: $data->name,
            description: $data->description,
            published: $data->published,
            group_id: $data->group_id,
            capacity: $data->capacity ?? null,
            dogma_attributes: isset($data->dogma_attributes) ? array_map(fn(object $i) => GetUniverseTypesTypeIdResponseDogmaAttributesItem::from($i), (array) $data->dogma_attributes) : null,
            dogma_effects: isset($data->dogma_effects) ? array_map(fn(object $i) => GetUniverseTypesTypeIdResponseDogmaEffectsItem::from($i), (array) $data->dogma_effects) : null,
            graphic_id: $data->graphic_id ?? null,
            icon_id: $data->icon_id ?? null,
            market_group_id: $data->market_group_id ?? null,
            mass: $data->mass ?? null,
            packaged_volume: $data->packaged_volume ?? null,
            portion_size: $data->portion_size ?? null,
            radius: $data->radius ?? null,
            volume: $data->volume ?? null,
        );
    }
}