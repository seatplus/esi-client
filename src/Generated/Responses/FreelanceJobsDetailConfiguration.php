<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailConfiguration
{
    public function __construct(
        public readonly string $method,
        public readonly mixed $parameters,
        public readonly int $version,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            method: (string) ($data->method ?? ''),
            parameters: ($data->parameters ?? null),
            version: (int) ($data->version ?? 0),
        );
    }
}