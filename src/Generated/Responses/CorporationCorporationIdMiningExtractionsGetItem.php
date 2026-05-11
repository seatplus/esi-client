<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationCorporationIdMiningExtractionsGetItem
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
            chunk_arrival_time: $data->chunk_arrival_time,
            extraction_start_time: $data->extraction_start_time,
            moon_id: $data->moon_id,
            natural_decay_time: $data->natural_decay_time,
            structure_id: $data->structure_id,
        );
    }
}