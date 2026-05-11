<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseGroupsGroupIdGet
{
    public function __construct(
        public readonly int $category_id,
        public readonly int $group_id,
        public readonly string $name,
        public readonly bool $published,
        public readonly array $types,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            category_id: (int) ($data->category_id ?? 0),
            group_id: (int) ($data->group_id ?? 0),
            name: (string) ($data->name ?? ''),
            published: (bool) ($data->published ?? false),
            types: (array) ($data->types ?? []),
        );
    }
}