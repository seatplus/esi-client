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
            description: (string) ($data->description ?? ''),
            faction_id: (int) ($data->faction_id ?? 0),
            is_unique: (bool) ($data->is_unique ?? false),
            name: (string) ($data->name ?? ''),
            size_factor: (float) ($data->size_factor ?? 0.0),
            station_count: (int) ($data->station_count ?? 0),
            station_system_count: (int) ($data->station_system_count ?? 0),
            corporation_id: $data->corporation_id ?? null,
            militia_corporation_id: $data->militia_corporation_id ?? null,
            solar_system_id: $data->solar_system_id ?? null,
        );
    }
}