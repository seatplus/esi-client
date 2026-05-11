<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailParameteroptions
{
    public function __construct(
        public readonly array $selected,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            selected: (array) ($data->selected ?? []),
        );
    }
}