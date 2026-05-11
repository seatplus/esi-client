<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdLocationGet
{
    public function __construct(
        public readonly int $solar_system_id,
        public readonly ?int $station_id = null,
        public readonly ?int $structure_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            solar_system_id: $data->solar_system_id,
            station_id: $data->station_id ?? null,
            structure_id: $data->structure_id ?? null,
        );
    }
}