<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdPlanetsPlanetIdGet
{
    public function __construct(
        public readonly array $links,
        public readonly array $pins,
        public readonly array $routes,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            links: (array) ($data->links ?? []),
            pins: (array) ($data->pins ?? []),
            routes: (array) ($data->routes ?? []),
        );
    }
}