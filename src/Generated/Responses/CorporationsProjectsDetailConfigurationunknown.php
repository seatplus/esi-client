<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationunknown
{
    public function __construct(
        public readonly mixed $data,
        public readonly string $type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            data: ($data->data ?? null),
            type: (string) ($data->type ?? ''),
        );
    }
}