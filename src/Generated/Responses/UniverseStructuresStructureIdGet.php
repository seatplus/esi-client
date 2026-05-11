<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseStructuresStructureIdGet
{
    public function __construct(
        public readonly string $name,
        public readonly int $owner_id,
        public readonly int $solar_system_id,
        public readonly mixed $position = null,
        public readonly ?int $type_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: (string) ($data->name ?? ''),
            owner_id: (int) ($data->owner_id ?? 0),
            solar_system_id: (int) ($data->solar_system_id ?? 0),
            position: $data->position ?? null,
            type_id: $data->type_id ?? null,
        );
    }
}