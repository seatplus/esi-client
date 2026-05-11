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
            bloodline_id: $data->bloodline_id,
            charisma: $data->charisma,
            corporation_id: $data->corporation_id,
            description: $data->description,
            intelligence: $data->intelligence,
            memory: $data->memory,
            name: $data->name,
            perception: $data->perception,
            race_id: $data->race_id,
            ship_type_id: $data->ship_type_id,
            willpower: $data->willpower,
        );
    }
}