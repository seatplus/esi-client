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
            last_update: (string) ($data->last_update ?? ''),
            num_pins: (int) ($data->num_pins ?? 0),
            owner_id: (int) ($data->owner_id ?? 0),
            planet_id: (int) ($data->planet_id ?? 0),
            planet_type: (string) ($data->planet_type ?? ''),
            solar_system_id: (int) ($data->solar_system_id ?? 0),
            upgrade_level: (int) ($data->upgrade_level ?? 0),
        );
    }
}