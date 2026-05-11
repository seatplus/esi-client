<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseCategoriesCategoryIdResponse
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
            category_id: $data->category_id,
            name: $data->name,
            published: $data->published,
            groups: $data->groups,
        );
    }
}