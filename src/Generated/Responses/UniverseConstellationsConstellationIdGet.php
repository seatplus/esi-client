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
            constellation_id: (int) ($data->constellation_id ?? 0),
            name: (string) ($data->name ?? ''),
            position: ($data->position ?? null),
            region_id: (int) ($data->region_id ?? 0),
            systems: (array) ($data->systems ?? []),
        );
    }
}