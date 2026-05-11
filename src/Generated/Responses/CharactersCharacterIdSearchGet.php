<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdSearchGet
{
    public function __construct(
        public readonly ?array $agent = null,
        public readonly ?array $alliance = null,
        public readonly ?array $character = null,
        public readonly ?array $constellation = null,
        public readonly ?array $corporation = null,
        public readonly ?array $faction = null,
        public readonly ?array $inventory_type = null,
        public readonly ?array $region = null,
        public readonly ?array $solar_system = null,
        public readonly ?array $station = null,
        public readonly ?array $structure = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            agent: isset($data->agent) ? (array) $data->agent : null,
            alliance: isset($data->alliance) ? (array) $data->alliance : null,
            character: isset($data->character) ? (array) $data->character : null,
            constellation: isset($data->constellation) ? (array) $data->constellation : null,
            corporation: isset($data->corporation) ? (array) $data->corporation : null,
            faction: isset($data->faction) ? (array) $data->faction : null,
            inventory_type: isset($data->inventory_type) ? (array) $data->inventory_type : null,
            region: isset($data->region) ? (array) $data->region : null,
            solar_system: isset($data->solar_system) ? (array) $data->solar_system : null,
            station: isset($data->station) ? (array) $data->station : null,
            structure: isset($data->structure) ? (array) $data->structure : null,
        );
    }
}