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
            character_id: (int) ($data->character_id ?? 0),
            join_time: (string) ($data->join_time ?? ''),
            role: (string) ($data->role ?? ''),
            role_name: (string) ($data->role_name ?? ''),
            ship_type_id: (int) ($data->ship_type_id ?? 0),
            solar_system_id: (int) ($data->solar_system_id ?? 0),
            squad_id: (int) ($data->squad_id ?? 0),
            takes_fleet_warp: (bool) ($data->takes_fleet_warp ?? false),
            wing_id: (int) ($data->wing_id ?? 0),
            station_id: $data->station_id ?? null,
        );
    }
}