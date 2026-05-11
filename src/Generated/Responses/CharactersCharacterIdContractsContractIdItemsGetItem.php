<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdContractsContractIdItemsGetItem
{
    public function __construct(
        public readonly bool $is_included,
        public readonly bool $is_singleton,
        public readonly int $quantity,
        public readonly int $record_id,
        public readonly int $type_id,
        public readonly ?int $raw_quantity = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            is_included: (bool) ($data->is_included ?? false),
            is_singleton: (bool) ($data->is_singleton ?? false),
            quantity: (int) ($data->quantity ?? 0),
            record_id: (int) ($data->record_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
            raw_quantity: $data->raw_quantity ?? null,
        );
    }
}