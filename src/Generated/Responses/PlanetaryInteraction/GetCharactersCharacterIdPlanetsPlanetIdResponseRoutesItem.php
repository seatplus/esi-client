<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsPlanetIdResponseRoutesItem
{
    public function __construct(
        public readonly int $content_type_id,
        public readonly int $destination_pin_id,
        public readonly float $quantity,
        public readonly int $route_id,
        public readonly int $source_pin_id,
        public readonly ?array $waypoints = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            route_id: $data->route_id,
            source_pin_id: $data->source_pin_id,
            destination_pin_id: $data->destination_pin_id,
            content_type_id: $data->content_type_id,
            quantity: $data->quantity,
            waypoints: $data->waypoints ?? null,
        );
    }
}