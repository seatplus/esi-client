<?php

namespace Seatplus\EsiClient\Generated\Responses\Insurance;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetInsurancePricesItemLevelsItem
{
    public function __construct(
        public readonly float $cost,
        public readonly string $name,
        public readonly float $payout,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            cost: $data->cost,
            payout: $data->payout,
            name: $data->name,
        );
    }
}