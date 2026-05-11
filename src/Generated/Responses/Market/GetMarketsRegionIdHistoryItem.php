<?php

namespace Seatplus\EsiClient\Generated\Responses\Market;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetMarketsRegionIdHistoryItem
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
            date: $data->date,
            order_count: $data->order_count,
            volume: $data->volume,
            highest: $data->highest,
            average: $data->average,
            lowest: $data->lowest,
        );
    }
}