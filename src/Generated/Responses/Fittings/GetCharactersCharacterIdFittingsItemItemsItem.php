<?php

namespace Seatplus\EsiClient\Generated\Responses\Fittings;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdFittingsItemItemsItem
{
    public function __construct(
        public readonly string $flag,
        public readonly int $quantity,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            type_id: $data->type_id,
            flag: $data->flag,
            quantity: $data->quantity,
        );
    }
}