<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdPlanetsGetItem
{
    public function __construct(
        public readonly string $last_update,
        public readonly int $num_pins,
        public readonly int $owner_id,
        public readonly int $planet_id,
        public readonly string $planet_type,
        public readonly int $solar_system_id,
        public readonly int $upgrade_level,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            last_update: $data->last_update,
            num_pins: $data->num_pins,
            owner_id: $data->owner_id,
            planet_id: $data->planet_id,
            planet_type: $data->planet_type,
            solar_system_id: $data->solar_system_id,
            upgrade_level: $data->upgrade_level,
        );
    }
}