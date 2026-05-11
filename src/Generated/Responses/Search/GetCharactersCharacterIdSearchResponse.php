<?php

namespace Seatplus\EsiClient\Generated\Responses\Search;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdSearchResponse
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
            agent: $data->agent ?? null,
            alliance: $data->alliance ?? null,
            character: $data->character ?? null,
            constellation: $data->constellation ?? null,
            corporation: $data->corporation ?? null,
            faction: $data->faction ?? null,
            inventory_type: $data->inventory_type ?? null,
            region: $data->region ?? null,
            solar_system: $data->solar_system ?? null,
            station: $data->station ?? null,
            structure: $data->structure ?? null,
        );
    }
}