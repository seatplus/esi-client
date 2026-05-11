<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseRacesGetItem
{
    public function __construct(
        public readonly int $alliance_id,
        public readonly string $description,
        public readonly string $name,
        public readonly int $race_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            alliance_id: (int) ($data->alliance_id ?? 0),
            description: (string) ($data->description ?? ''),
            name: (string) ($data->name ?? ''),
            race_id: (int) ($data->race_id ?? 0),
        );
    }
}