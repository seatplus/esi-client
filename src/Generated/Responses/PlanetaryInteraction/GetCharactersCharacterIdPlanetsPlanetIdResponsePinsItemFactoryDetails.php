<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemFactoryDetails
{
    public function __construct(
        public readonly int $schematic_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            schematic_id: $data->schematic_id,
        );
    }
}