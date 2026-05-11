<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseGroupsGroupIdResponse
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
            group_id: $data->group_id,
            name: $data->name,
            published: $data->published,
            category_id: $data->category_id,
            types: $data->types,
        );
    }
}