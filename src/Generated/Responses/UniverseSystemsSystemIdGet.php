<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseSystemsSystemIdGet
{
    public function __construct(
        public readonly int $constellation_id,
        public readonly string $name,
        public readonly mixed $position,
        public readonly float $security_status,
        public readonly int $system_id,
        public readonly ?array $planets = null,
        public readonly ?string $security_class = null,
        public readonly ?int $star_id = null,
        public readonly ?array $stargates = null,
        public readonly ?array $stations = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            constellation_id: $data->constellation_id,
            name: $data->name,
            position: $data->position,
            security_status: $data->security_status,
            system_id: $data->system_id,
            planets: isset($data->planets) ? (array) $data->planets : null,
            security_class: $data->security_class ?? null,
            star_id: $data->star_id ?? null,
            stargates: isset($data->stargates) ? (array) $data->stargates : null,
            stations: isset($data->stations) ? (array) $data->stations : null,
        );
    }
}