<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseSchematicsSchematicIdGet
{
    public function __construct(
        public readonly int $cycle_time,
        public readonly string $schematic_name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            cycle_time: $data->cycle_time,
            schematic_name: $data->schematic_name,
        );
    }
}