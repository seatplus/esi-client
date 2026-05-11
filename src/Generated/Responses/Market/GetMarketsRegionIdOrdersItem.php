<?php

namespace Seatplus\EsiClient\Generated\Responses\Market;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetMarketsRegionIdOrdersItem
{
    public function __construct(
        public readonly int $duration,
        public readonly bool $is_buy_order,
        public readonly string $issued,
        public readonly int $location_id,
        public readonly int $min_volume,
        public readonly int $order_id,
        public readonly float $price,
        public readonly string $range,
        public readonly int $system_id,
        public readonly int $type_id,
        public readonly int $volume_remain,
        public readonly int $volume_total,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            order_id: $data->order_id,
            type_id: $data->type_id,
            location_id: $data->location_id,
            system_id: $data->system_id,
            volume_total: $data->volume_total,
            volume_remain: $data->volume_remain,
            min_volume: $data->min_volume,
            price: $data->price,
            is_buy_order: $data->is_buy_order,
            duration: $data->duration,
            issued: $data->issued,
            range: $data->range,
        );
    }
}