<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class SovereigntyStructuresGetItem
{
    public function __construct(
        public readonly int $alliance_id,
        public readonly int $solar_system_id,
        public readonly int $structure_id,
        public readonly int $structure_type_id,
        public readonly ?float $vulnerability_occupancy_level = null,
        public readonly ?string $vulnerable_end_time = null,
        public readonly ?string $vulnerable_start_time = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            alliance_id: (int) ($data->alliance_id ?? 0),
            solar_system_id: (int) ($data->solar_system_id ?? 0),
            structure_id: (int) ($data->structure_id ?? 0),
            structure_type_id: (int) ($data->structure_type_id ?? 0),
            vulnerability_occupancy_level: $data->vulnerability_occupancy_level ?? null,
            vulnerable_end_time: $data->vulnerable_end_time ?? null,
            vulnerable_start_time: $data->vulnerable_start_time ?? null,
        );
    }
}