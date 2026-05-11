<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseBloodlinesGetItem
{
    public function __construct(
        public readonly int $bloodline_id,
        public readonly int $charisma,
        public readonly int $corporation_id,
        public readonly string $description,
        public readonly int $intelligence,
        public readonly int $memory,
        public readonly string $name,
        public readonly int $perception,
        public readonly int $race_id,
        public readonly int $ship_type_id,
        public readonly int $willpower,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            bloodline_id: (int) ($data->bloodline_id ?? 0),
            charisma: (int) ($data->charisma ?? 0),
            corporation_id: (int) ($data->corporation_id ?? 0),
            description: (string) ($data->description ?? ''),
            intelligence: (int) ($data->intelligence ?? 0),
            memory: (int) ($data->memory ?? 0),
            name: (string) ($data->name ?? ''),
            perception: (int) ($data->perception ?? 0),
            race_id: (int) ($data->race_id ?? 0),
            ship_type_id: (int) ($data->ship_type_id ?? 0),
            willpower: (int) ($data->willpower ?? 0),
        );
    }
}