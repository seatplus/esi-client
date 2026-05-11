<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsPlanetIdResponse
{
    public function __construct(
        public readonly array $links,
        public readonly array $pins,
        public readonly array $routes,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            links: array_map(fn(object $i) => GetCharactersCharacterIdPlanetsPlanetIdResponseLinksItem::from($i), (array) $data->links),
            pins: array_map(fn(object $i) => GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItem::from($i), (array) $data->pins),
            routes: array_map(fn(object $i) => GetCharactersCharacterIdPlanetsPlanetIdResponseRoutesItem::from($i), (array) $data->routes),
        );
    }
}