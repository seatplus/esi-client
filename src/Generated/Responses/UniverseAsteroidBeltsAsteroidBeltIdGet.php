<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseAsteroidBeltsAsteroidBeltIdGet
{
    public function __construct(
        public readonly string $name,
        public readonly mixed $position,
        public readonly int $system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name,
            position: $data->position,
            system_id: $data->system_id,
        );
    }
}