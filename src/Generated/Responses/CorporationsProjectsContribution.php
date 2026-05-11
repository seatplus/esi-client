<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsContribution
{
    public function __construct(
        public readonly int $contributed,
        public readonly ?string $last_modified = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            contributed: (int) ($data->contributed ?? 0),
            last_modified: $data->last_modified ?? null,
        );
    }
}