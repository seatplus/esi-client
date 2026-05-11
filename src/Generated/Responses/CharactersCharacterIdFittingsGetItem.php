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
            description: (string) ($data->description ?? ''),
            fitting_id: (int) ($data->fitting_id ?? 0),
            items: (array) ($data->items ?? []),
            name: (string) ($data->name ?? ''),
            ship_type_id: (int) ($data->ship_type_id ?? 0),
        );
    }
}