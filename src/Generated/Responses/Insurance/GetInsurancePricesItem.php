<?php

namespace Seatplus\EsiClient\Generated\Responses\Insurance;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetInsurancePricesItem
{
    public function __construct(
        public readonly array $levels,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            type_id: $data->type_id,
            levels: array_map(fn(object $i) => GetInsurancePricesItemLevelsItem::from($i), (array) $data->levels),
        );
    }
}