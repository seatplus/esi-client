<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class IncursionsGetItem
{
    public function __construct(
        public readonly int $constellation_id,
        public readonly int $faction_id,
        public readonly bool $has_boss,
        public readonly array $infested_solar_systems,
        public readonly float $influence,
        public readonly int $staging_solar_system_id,
        public readonly string $state,
        public readonly string $type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            constellation_id: (int) ($data->constellation_id ?? 0),
            faction_id: (int) ($data->faction_id ?? 0),
            has_boss: (bool) ($data->has_boss ?? false),
            infested_solar_systems: (array) ($data->infested_solar_systems ?? []),
            influence: (float) ($data->influence ?? 0.0),
            staging_solar_system_id: (int) ($data->staging_solar_system_id ?? 0),
            state: (string) ($data->state ?? ''),
            type: (string) ($data->type ?? ''),
        );
    }
}