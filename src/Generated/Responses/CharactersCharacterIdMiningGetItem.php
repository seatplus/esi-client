<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdMiningGetItem
{
    public function __construct(
        public readonly string $date,
        public readonly int $quantity,
        public readonly int $solar_system_id,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            date: $data->date,
            quantity: $data->quantity,
            solar_system_id: $data->solar_system_id,
            type_id: $data->type_id,
        );
    }
}