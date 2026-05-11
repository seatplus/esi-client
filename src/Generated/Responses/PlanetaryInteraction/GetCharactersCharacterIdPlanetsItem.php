<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsItem
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
            solar_system_id: $data->solar_system_id,
            planet_id: $data->planet_id,
            planet_type: $data->planet_type,
            owner_id: $data->owner_id,
            last_update: $data->last_update,
            upgrade_level: $data->upgrade_level,
            num_pins: $data->num_pins,
        );
    }
}