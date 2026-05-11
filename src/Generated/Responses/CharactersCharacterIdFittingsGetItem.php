<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdFittingsGetItem
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
            description: $data->description,
            fitting_id: $data->fitting_id,
            items: (array) ($data->items ?? []),
            name: $data->name,
            ship_type_id: $data->ship_type_id,
        );
    }
}