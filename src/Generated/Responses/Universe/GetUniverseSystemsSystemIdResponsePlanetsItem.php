<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseSystemsSystemIdResponsePlanetsItem
{
    public function __construct(
        public readonly int $planet_id,
        public readonly ?array $asteroid_belts = null,
        public readonly ?array $moons = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            planet_id: $data->planet_id,
            asteroid_belts: $data->asteroid_belts ?? null,
            moons: $data->moons ?? null,
        );
    }
}