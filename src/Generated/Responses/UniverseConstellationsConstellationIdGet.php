<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseConstellationsConstellationIdGet
{
    public function __construct(
        public readonly int $constellation_id,
        public readonly string $name,
        public readonly mixed $position,
        public readonly int $region_id,
        public readonly array $systems,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            constellation_id: $data->constellation_id,
            name: $data->name,
            position: $data->position,
            region_id: $data->region_id,
            systems: (array) ($data->systems ?? []),
        );
    }
}