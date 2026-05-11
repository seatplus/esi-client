<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseStargatesStargateIdGet
{
    public function __construct(
        public readonly mixed $destination,
        public readonly string $name,
        public readonly mixed $position,
        public readonly int $stargate_id,
        public readonly int $system_id,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            destination: $data->destination,
            name: $data->name,
            position: $data->position,
            stargate_id: $data->stargate_id,
            system_id: $data->system_id,
            type_id: $data->type_id,
        );
    }
}