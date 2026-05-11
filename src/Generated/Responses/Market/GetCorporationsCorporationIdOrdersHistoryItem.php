<?php

namespace Seatplus\EsiClient\Generated\Responses\Market;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdOrdersHistoryItem
{
    public function __construct(
        public readonly int $duration,
        public readonly string $issued,
        public readonly int $location_id,
        public readonly int $order_id,
        public readonly float $price,
        public readonly string $range,
        public readonly int $region_id,
        public readonly string $state,
        public readonly int $type_id,
        public readonly int $volume_remain,
        public readonly int $volume_total,
        public readonly int $wallet_division,
        public readonly ?float $escrow = null,
        public readonly ?bool $is_buy_order = null,
        public readonly ?int $issued_by = null,
        public readonly ?int $min_volume = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            wallet_division: $data->wallet_division,
            duration: $data->duration,
            state: $data->state,
            order_id: $data->order_id,
            type_id: $data->type_id,
            region_id: $data->region_id,
            location_id: $data->location_id,
            range: $data->range,
            price: $data->price,
            volume_total: $data->volume_total,
            volume_remain: $data->volume_remain,
            issued: $data->issued,
            escrow: $data->escrow ?? null,
            is_buy_order: $data->is_buy_order ?? null,
            issued_by: $data->issued_by ?? null,
            min_volume: $data->min_volume ?? null,
        );
    }
}