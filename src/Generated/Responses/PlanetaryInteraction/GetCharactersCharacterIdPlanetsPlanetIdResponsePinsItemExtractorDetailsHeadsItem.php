<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemExtractorDetailsHeadsItem
{
    public function __construct(
        public readonly int $head_id,
        public readonly float $latitude,
        public readonly float $longitude,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            head_id: $data->head_id,
            latitude: $data->latitude,
            longitude: $data->longitude,
        );
    }
}