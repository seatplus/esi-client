<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class LoyaltyStoresCorporationIdOffersGetItem
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
            isk_cost: $data->isk_cost,
            lp_cost: $data->lp_cost,
            offer_id: $data->offer_id,
            quantity: $data->quantity,
            required_items: (array) ($data->required_items ?? []),
            type_id: $data->type_id,
            ak_cost: $data->ak_cost ?? null,
        );
    }
}