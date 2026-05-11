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
            client_id: (int) ($data->client_id ?? 0),
            date: (string) ($data->date ?? ''),
            is_buy: (bool) ($data->is_buy ?? false),
            is_personal: (bool) ($data->is_personal ?? false),
            journal_ref_id: (int) ($data->journal_ref_id ?? 0),
            location_id: (int) ($data->location_id ?? 0),
            quantity: (int) ($data->quantity ?? 0),
            transaction_id: (int) ($data->transaction_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
            unit_price: (float) ($data->unit_price ?? 0.0),
        );
    }
}