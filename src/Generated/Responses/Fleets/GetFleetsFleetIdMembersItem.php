<?php

namespace Seatplus\EsiClient\Generated\Responses\Fleets;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFleetsFleetIdMembersItem
{
    public function __construct(
        public readonly int $character_id,
        public readonly string $join_time,
        public readonly string $role,
        public readonly string $role_name,
        public readonly int $ship_type_id,
        public readonly int $solar_system_id,
        public readonly int $squad_id,
        public readonly bool $takes_fleet_warp,
        public readonly int $wing_id,
        public readonly ?int $station_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character_id: $data->character_id,
            ship_type_id: $data->ship_type_id,
            wing_id: $data->wing_id,
            squad_id: $data->squad_id,
            role: $data->role,
            role_name: $data->role_name,
            join_time: $data->join_time,
            takes_fleet_warp: $data->takes_fleet_warp,
            solar_system_id: $data->solar_system_id,
            station_id: $data->station_id ?? null,
        );
    }
}