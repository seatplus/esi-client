<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseFactionsItem
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
            faction_id: $data->faction_id,
            name: $data->name,
            description: $data->description,
            size_factor: $data->size_factor,
            station_count: $data->station_count,
            station_system_count: $data->station_system_count,
            is_unique: $data->is_unique,
            corporation_id: $data->corporation_id ?? null,
            militia_corporation_id: $data->militia_corporation_id ?? null,
            solar_system_id: $data->solar_system_id ?? null,
        );
    }
}