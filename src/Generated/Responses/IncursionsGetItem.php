<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class IncursionsGetItem
{
    public function __construct(
        public readonly int $constellation_id,
        public readonly int $faction_id,
        public readonly bool $has_boss,
        public readonly array $infested_solar_systems,
        public readonly float $influence,
        public readonly int $staging_solar_system_id,
        public readonly string $state,
        public readonly string $type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            constellation_id: $data->constellation_id,
            faction_id: $data->faction_id,
            has_boss: $data->has_boss,
            infested_solar_systems: (array) ($data->infested_solar_systems ?? []),
            influence: $data->influence,
            staging_solar_system_id: $data->staging_solar_system_id,
            state: $data->state,
            type: $data->type,
        );
    }
}