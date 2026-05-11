<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseIdsPost
{
    public function __construct(
        public readonly ?array $agents = null,
        public readonly ?array $alliances = null,
        public readonly ?array $characters = null,
        public readonly ?array $constellations = null,
        public readonly ?array $corporations = null,
        public readonly ?array $factions = null,
        public readonly ?array $inventory_types = null,
        public readonly ?array $regions = null,
        public readonly ?array $stations = null,
        public readonly ?array $systems = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            agents: isset($data->agents) ? (array) $data->agents : null,
            alliances: isset($data->alliances) ? (array) $data->alliances : null,
            characters: isset($data->characters) ? (array) $data->characters : null,
            constellations: isset($data->constellations) ? (array) $data->constellations : null,
            corporations: isset($data->corporations) ? (array) $data->corporations : null,
            factions: isset($data->factions) ? (array) $data->factions : null,
            inventory_types: isset($data->inventory_types) ? (array) $data->inventory_types : null,
            regions: isset($data->regions) ? (array) $data->regions : null,
            stations: isset($data->stations) ? (array) $data->stations : null,
            systems: isset($data->systems) ? (array) $data->systems : null,
        );
    }
}