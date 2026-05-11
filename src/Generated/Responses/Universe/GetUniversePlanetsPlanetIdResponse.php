<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniversePlanetsPlanetIdResponse
{
    public function __construct(
        public readonly string $name,
        public readonly int $planet_id,
        public readonly GetUniversePlanetsPlanetIdResponsePosition $position,
        public readonly int $system_id,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            planet_id: $data->planet_id,
            name: $data->name,
            type_id: $data->type_id,
            position: GetUniversePlanetsPlanetIdResponsePosition::from($data->position),
            system_id: $data->system_id,
        );
    }
}