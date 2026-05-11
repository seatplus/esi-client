<?php

namespace Seatplus\EsiClient\Generated\Responses\Contracts;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdContractsContractIdBidsItem
{
    public function __construct(
        public readonly float $amount,
        public readonly int $bid_id,
        public readonly int $bidder_id,
        public readonly string $date_bid,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            bid_id: $data->bid_id,
            bidder_id: $data->bidder_id,
            date_bid: $data->date_bid,
            amount: $data->amount,
        );
    }
}