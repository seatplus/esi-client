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
            activity_id: $data->activity_id,
            blueprint_id: $data->blueprint_id,
            blueprint_location_id: $data->blueprint_location_id,
            blueprint_type_id: $data->blueprint_type_id,
            duration: $data->duration,
            end_date: $data->end_date,
            facility_id: $data->facility_id,
            installer_id: $data->installer_id,
            job_id: $data->job_id,
            location_id: $data->location_id,
            output_location_id: $data->output_location_id,
            runs: $data->runs,
            start_date: $data->start_date,
            status: $data->status,
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