<?php

namespace Seatplus\EsiClient\Generated\Responses\Sovereignty;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetSovereigntyStructuresItem
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
            alliance_id: $data->alliance_id,
            solar_system_id: $data->solar_system_id,
            structure_id: $data->structure_id,
            structure_type_id: $data->structure_type_id,
            vulnerability_occupancy_level: $data->vulnerability_occupancy_level ?? null,
            vulnerable_end_time: $data->vulnerable_end_time ?? null,
            vulnerable_start_time: $data->vulnerable_start_time ?? null,
        );
    }
}