<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItem
{
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly int $pin_id,
        public readonly int $type_id,
        public readonly ?array $contents = null,
        public readonly ?string $expiry_time = null,
        public readonly ?GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemExtractorDetails $extractor_details = null,
        public readonly ?GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemFactoryDetails $factory_details = null,
        public readonly ?string $install_time = null,
        public readonly ?string $last_cycle_start = null,
        public readonly ?int $schematic_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            pin_id: $data->pin_id,
            type_id: $data->type_id,
            latitude: $data->latitude,
            longitude: $data->longitude,
            contents: isset($data->contents) ? array_map(fn(object $i) => GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemContentsItem::from($i), (array) $data->contents) : null,
            expiry_time: $data->expiry_time ?? null,
            extractor_details: isset($data->extractor_details) ? GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemExtractorDetails::from($data->extractor_details) : null,
            factory_details: isset($data->factory_details) ? GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemFactoryDetails::from($data->factory_details) : null,
            install_time: $data->install_time ?? null,
            last_cycle_start: $data->last_cycle_start ?? null,
            schematic_id: $data->schematic_id ?? null,
        );
    }
}