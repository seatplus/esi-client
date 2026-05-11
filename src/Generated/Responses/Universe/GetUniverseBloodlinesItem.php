<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseBloodlinesItem
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
            name: $data->name,
            description: $data->description,
            race_id: $data->race_id,
            ship_type_id: $data->ship_type_id,
            corporation_id: $data->corporation_id,
            perception: $data->perception,
            willpower: $data->willpower,
            charisma: $data->charisma,
            memory: $data->memory,
            intelligence: $data->intelligence,
        );
    }
}