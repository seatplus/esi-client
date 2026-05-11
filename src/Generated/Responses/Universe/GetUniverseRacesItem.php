<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseRacesItem
{
    public function __construct(
        public readonly int $alliance_id,
        public readonly string $description,
        public readonly string $name,
        public readonly int $race_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            race_id: $data->race_id,
            name: $data->name,
            description: $data->description,
            alliance_id: $data->alliance_id,
        );
    }
}