<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseTypesTypeIdResponseDogmaAttributesItem
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