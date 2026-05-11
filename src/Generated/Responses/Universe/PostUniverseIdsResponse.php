<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class PostUniverseIdsResponse
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
            agents: isset($data->agents) ? array_map(fn(object $i) => PostUniverseIdsResponseAgentsItem::from($i), (array) $data->agents) : null,
            alliances: isset($data->alliances) ? array_map(fn(object $i) => PostUniverseIdsResponseAlliancesItem::from($i), (array) $data->alliances) : null,
            characters: isset($data->characters) ? array_map(fn(object $i) => PostUniverseIdsResponseCharactersItem::from($i), (array) $data->characters) : null,
            constellations: isset($data->constellations) ? array_map(fn(object $i) => PostUniverseIdsResponseConstellationsItem::from($i), (array) $data->constellations) : null,
            corporations: isset($data->corporations) ? array_map(fn(object $i) => PostUniverseIdsResponseCorporationsItem::from($i), (array) $data->corporations) : null,
            factions: isset($data->factions) ? array_map(fn(object $i) => PostUniverseIdsResponseFactionsItem::from($i), (array) $data->factions) : null,
            inventory_types: isset($data->inventory_types) ? array_map(fn(object $i) => PostUniverseIdsResponseInventoryTypesItem::from($i), (array) $data->inventory_types) : null,
            regions: isset($data->regions) ? array_map(fn(object $i) => PostUniverseIdsResponseRegionsItem::from($i), (array) $data->regions) : null,
            stations: isset($data->stations) ? array_map(fn(object $i) => PostUniverseIdsResponseStationsItem::from($i), (array) $data->stations) : null,
            systems: isset($data->systems) ? array_map(fn(object $i) => PostUniverseIdsResponseSystemsItem::from($i), (array) $data->systems) : null,
        );
    }
}