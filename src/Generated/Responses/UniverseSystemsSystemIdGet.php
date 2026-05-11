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
            constellation_id: (int) ($data->constellation_id ?? 0),
            name: (string) ($data->name ?? ''),
            position: ($data->position ?? null),
            security_status: (float) ($data->security_status ?? 0.0),
            system_id: (int) ($data->system_id ?? 0),
            planets: isset($data->planets) ? (array) $data->planets : null,
            security_class: $data->security_class ?? null,
            star_id: $data->star_id ?? null,
            stargates: isset($data->stargates) ? (array) $data->stargates : null,
            stations: isset($data->stations) ? (array) $data->stations : null,
        );
    }
}