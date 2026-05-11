<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseSchematicsSchematicIdResponse
{
    public function __construct(
        public readonly int $cycle_time,
        public readonly string $schematic_name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            schematic_name: $data->schematic_name,
            cycle_time: $data->cycle_time,
        );
    }
}