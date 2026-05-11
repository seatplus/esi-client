<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailRestrictions
{
    public function __construct(
        public readonly ?int $maximum_age = null,
        public readonly ?int $minimum_age = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            maximum_age: $data->maximum_age ?? null,
            minimum_age: $data->minimum_age ?? null,
        );
    }
}