<?php

namespace Seatplus\EsiClient\Generated\Responses\Industry;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationCorporationIdMiningExtractionsItem
{
    public function __construct(
        public readonly string $chunk_arrival_time,
        public readonly string $extraction_start_time,
        public readonly int $moon_id,
        public readonly string $natural_decay_time,
        public readonly int $structure_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            structure_id: $data->structure_id,
            moon_id: $data->moon_id,
            extraction_start_time: $data->extraction_start_time,
            chunk_arrival_time: $data->chunk_arrival_time,
            natural_decay_time: $data->natural_decay_time,
        );
    }
}