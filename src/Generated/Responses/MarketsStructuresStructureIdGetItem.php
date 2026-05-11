<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class MarketsStructuresStructureIdGetItem
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
        public readonly int $type_id,
        public readonly int $volume_remain,
        public readonly int $volume_total,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            duration: $data->duration,
            is_buy_order: $data->is_buy_order,
            issued: $data->issued,
            location_id: $data->location_id,
            min_volume: $data->min_volume,
            order_id: $data->order_id,
            price: $data->price,
            range: $data->range,
            type_id: $data->type_id,
            volume_remain: $data->volume_remain,
            volume_total: $data->volume_total,
        );
    }
}