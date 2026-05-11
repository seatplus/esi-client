<?php

namespace Seatplus\EsiClient\Generated\Responses\Fittings;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdFittingsItem
{
    public function __construct(
        public readonly string $description,
        public readonly int $fitting_id,
        public readonly array $items,
        public readonly string $name,
        public readonly int $ship_type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            fitting_id: $data->fitting_id,
            name: $data->name,
            description: $data->description,
            ship_type_id: $data->ship_type_id,
            items: array_map(fn(object $i) => GetCharactersCharacterIdFittingsItemItemsItem::from($i), (array) $data->items),
        );
    }
}