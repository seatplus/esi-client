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
            fleet_boss_id: (int) ($data->fleet_boss_id ?? 0),
            fleet_id: (int) ($data->fleet_id ?? 0),
            role: (string) ($data->role ?? ''),
            squad_id: (int) ($data->squad_id ?? 0),
            wing_id: (int) ($data->wing_id ?? 0),
        );
    }
}