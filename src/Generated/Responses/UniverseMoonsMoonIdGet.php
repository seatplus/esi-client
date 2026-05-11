<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseMoonsMoonIdGet
{
    public function __construct(
        public readonly int $moon_id,
        public readonly string $name,
        public readonly mixed $position,
        public readonly int $system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            moon_id: $data->moon_id,
            name: $data->name,
            position: $data->position,
            system_id: $data->system_id,
        );
    }
}