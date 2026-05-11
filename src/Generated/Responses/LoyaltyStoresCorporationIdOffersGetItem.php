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
            isk_cost: (int) ($data->isk_cost ?? 0),
            lp_cost: (int) ($data->lp_cost ?? 0),
            offer_id: (int) ($data->offer_id ?? 0),
            quantity: (int) ($data->quantity ?? 0),
            required_items: (array) ($data->required_items ?? []),
            type_id: (int) ($data->type_id ?? 0),
            ak_cost: $data->ak_cost ?? null,
        );
    }
}