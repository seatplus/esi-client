<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailParameterboolean
{
    public function __construct(
        public readonly bool $value,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            value: (bool) ($data->value ?? false),
        );
    }
}