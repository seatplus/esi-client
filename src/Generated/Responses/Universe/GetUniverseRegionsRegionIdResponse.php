<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseRegionsRegionIdResponse
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
            region_id: $data->region_id,
            name: $data->name,
            constellations: $data->constellations,
            description: $data->description ?? null,
        );
    }
}