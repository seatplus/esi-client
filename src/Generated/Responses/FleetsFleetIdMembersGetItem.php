<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FleetsFleetIdMembersGetItem
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
            join_time: $data->join_time,
            role: $data->role,
            role_name: $data->role_name,
            ship_type_id: $data->ship_type_id,
            solar_system_id: $data->solar_system_id,
            squad_id: $data->squad_id,
            takes_fleet_warp: $data->takes_fleet_warp,
            wing_id: $data->wing_id,
            station_id: $data->station_id ?? null,
        );
    }
}