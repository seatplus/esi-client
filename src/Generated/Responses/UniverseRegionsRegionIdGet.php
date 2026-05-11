<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseRegionsRegionIdGet
{
    public function __construct(
        public readonly array $constellations,
        public readonly string $name,
        public readonly int $region_id,
        public readonly ?string $description = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            constellations: (array) ($data->constellations ?? []),
            name: $data->name,
            region_id: $data->region_id,
            description: $data->description ?? null,
        );
    }
}