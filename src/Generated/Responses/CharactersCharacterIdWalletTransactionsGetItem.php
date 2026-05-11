<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdWalletTransactionsGetItem
{
    public function __construct(
        public readonly int $client_id,
        public readonly string $date,
        public readonly bool $is_buy,
        public readonly bool $is_personal,
        public readonly int $journal_ref_id,
        public readonly int $location_id,
        public readonly int $quantity,
        public readonly int $transaction_id,
        public readonly int $type_id,
        public readonly float $unit_price,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            client_id: $data->client_id,
            date: $data->date,
            is_buy: $data->is_buy,
            is_personal: $data->is_personal,
            journal_ref_id: $data->journal_ref_id,
            location_id: $data->location_id,
            quantity: $data->quantity,
            transaction_id: $data->transaction_id,
            type_id: $data->type_id,
            unit_price: $data->unit_price,
        );
    }
}