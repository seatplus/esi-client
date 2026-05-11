<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseSystemsSystemIdResponse
{
    public function __construct(
        public readonly int $constellation_id,
        public readonly string $name,
        public readonly GetUniverseSystemsSystemIdResponsePosition $position,
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
            system_id: $data->system_id,
            name: $data->name,
            position: GetUniverseSystemsSystemIdResponsePosition::from($data->position),
            security_status: $data->security_status,
            constellation_id: $data->constellation_id,
            planets: isset($data->planets) ? array_map(fn(object $i) => GetUniverseSystemsSystemIdResponsePlanetsItem::from($i), (array) $data->planets) : null,
            security_class: $data->security_class ?? null,
            star_id: $data->star_id ?? null,
            stargates: $data->stargates ?? null,
            stations: $data->stations ?? null,
        );
    }
}