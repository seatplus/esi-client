<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsContributorsContributor
{
    public function __construct(
        public readonly int $contributed,
        public readonly int $id,
        public readonly string $name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            contributed: (int) ($data->contributed ?? 0),
            id: (int) ($data->id ?? 0),
            name: (string) ($data->name ?? ''),
        );
    }
}