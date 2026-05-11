<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseFactionsGetItem
{
    public function __construct(
        public readonly string $description,
        public readonly int $faction_id,
        public readonly bool $is_unique,
        public readonly string $name,
        public readonly float $size_factor,
        public readonly int $station_count,
        public readonly int $station_system_count,
        public readonly ?int $corporation_id = null,
        public readonly ?int $militia_corporation_id = null,
        public readonly ?int $solar_system_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            description: $data->description,
            faction_id: $data->faction_id,
            is_unique: $data->is_unique,
            name: $data->name,
            size_factor: $data->size_factor,
            station_count: $data->station_count,
            station_system_count: $data->station_system_count,
            corporation_id: $data->corporation_id ?? null,
            militia_corporation_id: $data->militia_corporation_id ?? null,
            solar_system_id: $data->solar_system_id ?? null,
        );
    }
}