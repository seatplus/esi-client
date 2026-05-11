<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseStationsStationIdResponse
{
    public function __construct(
        public readonly float $max_dockable_ship_volume,
        public readonly string $name,
        public readonly float $office_rental_cost,
        public readonly GetUniverseStationsStationIdResponsePosition $position,
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
            station_id: $data->station_id,
            name: $data->name,
            type_id: $data->type_id,
            position: GetUniverseStationsStationIdResponsePosition::from($data->position),
            system_id: $data->system_id,
            reprocessing_efficiency: $data->reprocessing_efficiency,
            reprocessing_stations_take: $data->reprocessing_stations_take,
            max_dockable_ship_volume: $data->max_dockable_ship_volume,
            office_rental_cost: $data->office_rental_cost,
            services: $data->services,
            owner: $data->owner ?? null,
            race_id: $data->race_id ?? null,
        );
    }
}