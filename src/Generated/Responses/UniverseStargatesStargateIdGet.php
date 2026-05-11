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
            destination: ($data->destination ?? null),
            name: (string) ($data->name ?? ''),
            position: ($data->position ?? null),
            stargate_id: (int) ($data->stargate_id ?? 0),
            system_id: (int) ($data->system_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
        );
    }
}