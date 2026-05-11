<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class MarketsRegionIdHistoryGetItem
{
    public function __construct(
        public readonly float $average,
        public readonly string $date,
        public readonly float $highest,
        public readonly float $lowest,
        public readonly int $order_count,
        public readonly int $volume,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            average: $data->average,
            date: $data->date,
            highest: $data->highest,
            lowest: $data->lowest,
            order_count: $data->order_count,
            volume: $data->volume,
        );
    }
}