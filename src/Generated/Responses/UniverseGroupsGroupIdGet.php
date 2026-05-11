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
            category_id: $data->category_id,
            group_id: $data->group_id,
            name: $data->name,
            published: $data->published,
            types: (array) ($data->types ?? []),
        );
    }
}