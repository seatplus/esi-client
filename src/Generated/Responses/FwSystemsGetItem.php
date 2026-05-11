<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FwSystemsGetItem
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
            contested: (string) ($data->contested ?? ''),
            occupier_faction_id: (int) ($data->occupier_faction_id ?? 0),
            owner_faction_id: (int) ($data->owner_faction_id ?? 0),
            solar_system_id: (int) ($data->solar_system_id ?? 0),
            victory_points: (int) ($data->victory_points ?? 0),
            victory_points_threshold: (int) ($data->victory_points_threshold ?? 0),
        );
    }
}