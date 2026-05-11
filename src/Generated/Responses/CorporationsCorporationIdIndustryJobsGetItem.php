<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdIndustryJobsGetItem
{
    public function __construct(
        public readonly int $activity_id,
        public readonly int $blueprint_id,
        public readonly int $blueprint_location_id,
        public readonly int $blueprint_type_id,
        public readonly int $duration,
        public readonly string $end_date,
        public readonly int $facility_id,
        public readonly int $installer_id,
        public readonly int $job_id,
        public readonly int $location_id,
        public readonly int $output_location_id,
        public readonly int $runs,
        public readonly string $start_date,
        public readonly string $status,
        public readonly ?int $completed_character_id = null,
        public readonly ?string $completed_date = null,
        public readonly ?float $cost = null,
        public readonly ?int $licensed_runs = null,
        public readonly ?string $pause_date = null,
        public readonly ?float $probability = null,
        public readonly ?int $product_type_id = null,
        public readonly ?int $successful_runs = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            activity_id: (int) ($data->activity_id ?? 0),
            blueprint_id: (int) ($data->blueprint_id ?? 0),
            blueprint_location_id: (int) ($data->blueprint_location_id ?? 0),
            blueprint_type_id: (int) ($data->blueprint_type_id ?? 0),
            duration: (int) ($data->duration ?? 0),
            end_date: (string) ($data->end_date ?? ''),
            facility_id: (int) ($data->facility_id ?? 0),
            installer_id: (int) ($data->installer_id ?? 0),
            job_id: (int) ($data->job_id ?? 0),
            location_id: (int) ($data->location_id ?? 0),
            output_location_id: (int) ($data->output_location_id ?? 0),
            runs: (int) ($data->runs ?? 0),
            start_date: (string) ($data->start_date ?? ''),
            status: (string) ($data->status ?? ''),
            completed_character_id: $data->completed_character_id ?? null,
            completed_date: $data->completed_date ?? null,
            cost: $data->cost ?? null,
            licensed_runs: $data->licensed_runs ?? null,
            pause_date: $data->pause_date ?? null,
            probability: $data->probability ?? null,
            product_type_id: $data->product_type_id ?? null,
            successful_runs: $data->successful_runs ?? null,
        );
    }
}