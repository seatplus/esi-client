<?php

namespace Seatplus\EsiClient\Generated\Responses\Loyalty;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetLoyaltyStoresCorporationIdOffersItem
{
    public function __construct(
        public readonly int $isk_cost,
        public readonly int $lp_cost,
        public readonly int $offer_id,
        public readonly int $quantity,
        public readonly array $required_items,
        public readonly int $type_id,
        public readonly ?int $ak_cost = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            offer_id: $data->offer_id,
            type_id: $data->type_id,
            quantity: $data->quantity,
            lp_cost: $data->lp_cost,
            isk_cost: $data->isk_cost,
            required_items: array_map(fn(object $i) => GetLoyaltyStoresCorporationIdOffersItemRequiredItemsItem::from($i), (array) $data->required_items),
            ak_cost: $data->ak_cost ?? null,
        );
    }
}