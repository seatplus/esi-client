<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdWalletsDivisionJournalGetItem
{
    public function __construct(
        public readonly string $date,
        public readonly string $description,
        public readonly int $id,
        public readonly string $ref_type,
        public readonly ?float $amount = null,
        public readonly ?float $balance = null,
        public readonly ?int $context_id = null,
        public readonly ?string $context_id_type = null,
        public readonly ?int $first_party_id = null,
        public readonly ?string $reason = null,
        public readonly ?int $second_party_id = null,
        public readonly ?float $tax = null,
        public readonly ?int $tax_receiver_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            date: (string) ($data->date ?? ''),
            description: (string) ($data->description ?? ''),
            id: (int) ($data->id ?? 0),
            ref_type: (string) ($data->ref_type ?? ''),
            amount: $data->amount ?? null,
            balance: $data->balance ?? null,
            context_id: $data->context_id ?? null,
            context_id_type: $data->context_id_type ?? null,
            first_party_id: $data->first_party_id ?? null,
            reason: $data->reason ?? null,
            second_party_id: $data->second_party_id ?? null,
            tax: $data->tax ?? null,
            tax_receiver_id: $data->tax_receiver_id ?? null,
        );
    }
}