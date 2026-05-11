<?php

namespace Seatplus\EsiClient\Generated\Responses\Industry;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetIndustrySystemsItem
{
    public function __construct(
        public readonly array $cost_indices,
        public readonly int $solar_system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            solar_system_id: $data->solar_system_id,
            cost_indices: array_map(fn(object $i) => GetIndustrySystemsItemCostIndicesItem::from($i), (array) $data->cost_indices),
        );
    }
}