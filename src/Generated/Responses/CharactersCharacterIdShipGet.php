<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdShipGet
{
    public function __construct(
        public readonly int $ship_item_id,
        public readonly string $ship_name,
        public readonly int $ship_type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            ship_item_id: $data->ship_item_id,
            ship_name: $data->ship_name,
            ship_type_id: $data->ship_type_id,
        );
    }
}