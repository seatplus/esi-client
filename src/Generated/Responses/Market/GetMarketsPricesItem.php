<?php

namespace Seatplus\EsiClient\Generated\Responses\Market;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetMarketsPricesItem
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