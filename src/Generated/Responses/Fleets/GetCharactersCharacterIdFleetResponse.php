<?php

namespace Seatplus\EsiClient\Generated\Responses\Fleets;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdFleetResponse
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
            fleet_id: $data->fleet_id,
            wing_id: $data->wing_id,
            squad_id: $data->squad_id,
            role: $data->role,
            fleet_boss_id: $data->fleet_boss_id,
        );
    }
}