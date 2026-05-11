<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseCategoriesCategoryIdGet
{
    public function __construct(
        public readonly int $category_id,
        public readonly array $groups,
        public readonly string $name,
        public readonly bool $published,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            category_id: (int) ($data->category_id ?? 0),
            groups: (array) ($data->groups ?? []),
            name: (string) ($data->name ?? ''),
            published: (bool) ($data->published ?? false),
        );
    }
}