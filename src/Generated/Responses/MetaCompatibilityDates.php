<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class MetaCompatibilityDates
{
    public function __construct(
        public readonly array $compatibility_dates,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            compatibility_dates: (array) ($data->compatibility_dates ?? []),
        );
    }
}