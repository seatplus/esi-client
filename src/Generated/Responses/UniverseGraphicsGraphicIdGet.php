<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseGraphicsGraphicIdGet
{
    public function __construct(
        public readonly int $graphic_id,
        public readonly ?string $collision_file = null,
        public readonly ?string $graphic_file = null,
        public readonly ?string $icon_folder = null,
        public readonly ?string $sof_dna = null,
        public readonly ?string $sof_fation_name = null,
        public readonly ?string $sof_hull_name = null,
        public readonly ?string $sof_race_name = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            graphic_id: $data->graphic_id,
            collision_file: $data->collision_file ?? null,
            graphic_file: $data->graphic_file ?? null,
            icon_folder: $data->icon_folder ?? null,
            sof_dna: $data->sof_dna ?? null,
            sof_fation_name: $data->sof_fation_name ?? null,
            sof_hull_name: $data->sof_hull_name ?? null,
            sof_race_name: $data->sof_race_name ?? null,
        );
    }
}