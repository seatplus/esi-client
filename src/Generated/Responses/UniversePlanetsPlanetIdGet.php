<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniversePlanetsPlanetIdGet
{
    public function __construct(
        public readonly string $name,
        public readonly int $planet_id,
        public readonly mixed $position,
        public readonly int $system_id,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name,
            planet_id: $data->planet_id,
            position: $data->position,
            system_id: $data->system_id,
            type_id: $data->type_id,
        );
    }
}