<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemContentsItem
{
    public function __construct(
        public readonly int $amount,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            type_id: $data->type_id,
            amount: $data->amount,
        );
    }
}