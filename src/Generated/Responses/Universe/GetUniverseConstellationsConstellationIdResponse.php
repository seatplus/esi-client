<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseConstellationsConstellationIdResponse
{
    public function __construct(
        public readonly int $constellation_id,
        public readonly string $name,
        public readonly GetUniverseConstellationsConstellationIdResponsePosition $position,
        public readonly int $region_id,
        public readonly array $systems,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            constellation_id: $data->constellation_id,
            name: $data->name,
            position: GetUniverseConstellationsConstellationIdResponsePosition::from($data->position),
            region_id: $data->region_id,
            systems: $data->systems,
        );
    }
}