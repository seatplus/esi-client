<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class Cursor
{
    public function __construct(
        public readonly ?string $after = null,
        public readonly ?string $before = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            after: $data->after ?? null,
            before: $data->before ?? null,
        );
    }
}