<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseStationsStationIdGet
{
    public function __construct(
        public readonly float $max_dockable_ship_volume,
        public readonly string $name,
        public readonly float $office_rental_cost,
        public readonly mixed $position,
        public readonly float $reprocessing_efficiency,
        public readonly float $reprocessing_stations_take,
        public readonly array $services,
        public readonly int $station_id,
        public readonly int $system_id,
        public readonly int $type_id,
        public readonly ?int $owner = null,
        public readonly ?int $race_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            max_dockable_ship_volume: (float) ($data->max_dockable_ship_volume ?? 0.0),
            name: (string) ($data->name ?? ''),
            office_rental_cost: (float) ($data->office_rental_cost ?? 0.0),
            position: ($data->position ?? null),
            reprocessing_efficiency: (float) ($data->reprocessing_efficiency ?? 0.0),
            reprocessing_stations_take: (float) ($data->reprocessing_stations_take ?? 0.0),
            services: (array) ($data->services ?? []),
            station_id: (int) ($data->station_id ?? 0),
            system_id: (int) ($data->system_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
            owner: $data->owner ?? null,
            race_id: $data->race_id ?? null,
        );
    }
}