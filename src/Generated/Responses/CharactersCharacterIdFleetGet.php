<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdFleetGet
{
    public function __construct(
        public readonly int $fleet_boss_id,
        public readonly int $fleet_id,
        public readonly string $role,
        public readonly int $squad_id,
        public readonly int $wing_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            fleet_boss_id: $data->fleet_boss_id,
            fleet_id: $data->fleet_id,
            role: $data->role,
            squad_id: $data->squad_id,
            wing_id: $data->wing_id,
        );
    }
}