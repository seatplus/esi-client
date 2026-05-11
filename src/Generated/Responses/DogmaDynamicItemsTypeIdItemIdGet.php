<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class DogmaDynamicItemsTypeIdItemIdGet
{
    public function __construct(
        public readonly int $created_by,
        public readonly array $dogma_attributes,
        public readonly array $dogma_effects,
        public readonly int $mutator_type_id,
        public readonly int $source_type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            created_by: $data->created_by,
            dogma_attributes: (array) ($data->dogma_attributes ?? []),
            dogma_effects: (array) ($data->dogma_effects ?? []),
            mutator_type_id: $data->mutator_type_id,
            source_type_id: $data->source_type_id,
        );
    }
}