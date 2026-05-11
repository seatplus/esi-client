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
            name: (string) ($data->name ?? ''),
            planet_id: (int) ($data->planet_id ?? 0),
            position: ($data->position ?? null),
            system_id: (int) ($data->system_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
        );
    }
}