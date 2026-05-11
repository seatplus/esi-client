<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseStarsStarIdResponse
{
    public function __construct(
        public readonly int $age,
        public readonly float $luminosity,
        public readonly string $name,
        public readonly int $radius,
        public readonly int $solar_system_id,
        public readonly string $spectral_class,
        public readonly int $temperature,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name,
            type_id: $data->type_id,
            age: $data->age,
            luminosity: $data->luminosity,
            radius: $data->radius,
            spectral_class: $data->spectral_class,
            temperature: $data->temperature,
            solar_system_id: $data->solar_system_id,
        );
    }
}