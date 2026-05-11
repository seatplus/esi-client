<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsPlanetIdResponseLinksItem
{
    public function __construct(
        public readonly int $destination_pin_id,
        public readonly int $link_level,
        public readonly int $source_pin_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            source_pin_id: $data->source_pin_id,
            destination_pin_id: $data->destination_pin_id,
            link_level: $data->link_level,
        );
    }
}