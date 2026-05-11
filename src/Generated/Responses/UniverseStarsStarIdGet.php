<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseStarsStarIdGet
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
            age: $data->age,
            luminosity: $data->luminosity,
            name: $data->name,
            radius: $data->radius,
            solar_system_id: $data->solar_system_id,
            spectral_class: $data->spectral_class,
            temperature: $data->temperature,
            type_id: $data->type_id,
        );
    }
}