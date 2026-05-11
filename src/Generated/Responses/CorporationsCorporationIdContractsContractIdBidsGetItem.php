<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdContractsContractIdBidsGetItem
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
            amount: (float) ($data->amount ?? 0.0),
            bid_id: (int) ($data->bid_id ?? 0),
            bidder_id: (int) ($data->bidder_id ?? 0),
            date_bid: (string) ($data->date_bid ?? ''),
        );
    }
}