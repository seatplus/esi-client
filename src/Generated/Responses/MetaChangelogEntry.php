<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class MetaChangelogEntry
{
    public function __construct(
        public readonly string $compatibility_date,
        public readonly string $description,
        public readonly string $method,
        public readonly string $path,
        public readonly string $type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            compatibility_date: (string) ($data->compatibility_date ?? ''),
            description: (string) ($data->description ?? ''),
            method: (string) ($data->method ?? ''),
            path: (string) ($data->path ?? ''),
            type: (string) ($data->type ?? ''),
        );
    }
}