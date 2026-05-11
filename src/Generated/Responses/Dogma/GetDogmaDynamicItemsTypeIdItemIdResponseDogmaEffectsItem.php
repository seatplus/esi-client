<?php

namespace Seatplus\EsiClient\Generated\Responses\Dogma;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetDogmaDynamicItemsTypeIdItemIdResponseDogmaEffectsItem
{
    public function __construct(
        public readonly int $effect_id,
        public readonly bool $is_default,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            effect_id: $data->effect_id,
            is_default: $data->is_default,
        );
    }
}