<?php

namespace Seatplus\EsiClient\Generated\Responses\Incursions;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetIncursionsItem
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
            type: $data->type,
            state: $data->state,
            influence: $data->influence,
            has_boss: $data->has_boss,
            faction_id: $data->faction_id,
            constellation_id: $data->constellation_id,
            staging_solar_system_id: $data->staging_solar_system_id,
            infested_solar_systems: $data->infested_solar_systems,
        );
    }
}