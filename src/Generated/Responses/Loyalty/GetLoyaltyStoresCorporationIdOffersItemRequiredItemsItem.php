<?php

namespace Seatplus\EsiClient\Generated\Responses\Loyalty;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetLoyaltyStoresCorporationIdOffersItemRequiredItemsItem
{
    public function __construct(
        public readonly int $quantity,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            type_id: $data->type_id,
            quantity: $data->quantity,
        );
    }
}