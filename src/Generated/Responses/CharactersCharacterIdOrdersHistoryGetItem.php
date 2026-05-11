<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdOrdersHistoryGetItem
{
    public function __construct(
        public readonly int $duration,
        public readonly bool $is_corporation,
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
        public readonly ?float $escrow = null,
        public readonly ?bool $is_buy_order = null,
        public readonly ?int $min_volume = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            duration: $data->duration,
            is_corporation: $data->is_corporation,
            issued: $data->issued,
            location_id: $data->location_id,
            order_id: $data->order_id,
            price: $data->price,
            range: $data->range,
            region_id: $data->region_id,
            state: $data->state,
            type_id: $data->type_id,
            volume_remain: $data->volume_remain,
            volume_total: $data->volume_total,
            escrow: $data->escrow ?? null,
            is_buy_order: $data->is_buy_order ?? null,
            min_volume: $data->min_volume ?? null,
        );
    }
}