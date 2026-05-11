<?php

namespace Seatplus\EsiClient\Generated\Responses\Dogma;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetDogmaDynamicItemsTypeIdItemIdResponseDogmaAttributesItem
{
    public function __construct(
        public readonly int $attribute_id,
        public readonly float $value,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            attribute_id: $data->attribute_id,
            value: $data->value,
        );
    }
}