<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class MarketsPricesGetItem
{
    public function __construct(
        public readonly int $type_id,
        public readonly ?float $adjusted_price = null,
        public readonly ?float $average_price = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            type_id: $data->type_id,
            adjusted_price: $data->adjusted_price ?? null,
            average_price: $data->average_price ?? null,
        );
    }
}