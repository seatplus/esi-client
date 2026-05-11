<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class MarketsRegionIdOrdersGetItem
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
            duration: (int) ($data->duration ?? 0),
            is_buy_order: (bool) ($data->is_buy_order ?? false),
            issued: (string) ($data->issued ?? ''),
            location_id: (int) ($data->location_id ?? 0),
            min_volume: (int) ($data->min_volume ?? 0),
            order_id: (int) ($data->order_id ?? 0),
            price: (float) ($data->price ?? 0.0),
            range: (string) ($data->range ?? ''),
            system_id: (int) ($data->system_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
            volume_remain: (int) ($data->volume_remain ?? 0),
            volume_total: (int) ($data->volume_total ?? 0),
        );
    }
}