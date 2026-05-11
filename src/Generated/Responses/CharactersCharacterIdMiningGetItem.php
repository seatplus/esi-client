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
            date: (string) ($data->date ?? ''),
            quantity: (int) ($data->quantity ?? 0),
            solar_system_id: (int) ($data->solar_system_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
        );
    }
}