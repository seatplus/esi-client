<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class IndustrySystemsGetItem
{
    public function __construct(
        public readonly array $cost_indices,
        public readonly int $solar_system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            cost_indices: (array) ($data->cost_indices ?? []),
            solar_system_id: $data->solar_system_id,
        );
    }
}