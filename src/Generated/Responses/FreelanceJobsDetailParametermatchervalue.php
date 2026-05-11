<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailParametermatchervalue
{
    public function __construct(
        public readonly string $value_type,
        public readonly array $values,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            value_type: (string) ($data->value_type ?? ''),
            values: (array) ($data->values ?? []),
        );
    }
}