<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwSystemsItem
{
    public function __construct(
        public readonly string $contested,
        public readonly int $occupier_faction_id,
        public readonly int $owner_faction_id,
        public readonly int $solar_system_id,
        public readonly int $victory_points,
        public readonly int $victory_points_threshold,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            solar_system_id: $data->solar_system_id,
            occupier_faction_id: $data->occupier_faction_id,
            owner_faction_id: $data->owner_faction_id,
            victory_points: $data->victory_points,
            victory_points_threshold: $data->victory_points_threshold,
            contested: $data->contested,
        );
    }
}