<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class PostUniverseNamesItem
{
    public function __construct(
        public readonly string $category,
        public readonly int $id,
        public readonly string $name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            id: $data->id,
            name: $data->name,
            category: $data->category,
        );
    }
}