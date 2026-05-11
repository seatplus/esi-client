<?php

namespace Seatplus\EsiClient\Generated\Responses\Industry;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetIndustrySystemsItemCostIndicesItem
{
    public function __construct(
        public readonly string $activity,
        public readonly float $cost_index,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            activity: $data->activity,
            cost_index: $data->cost_index,
        );
    }
}