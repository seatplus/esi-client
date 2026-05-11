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
            is_included: $data->is_included,
            is_singleton: $data->is_singleton,
            quantity: $data->quantity,
            record_id: $data->record_id,
            type_id: $data->type_id,
            raw_quantity: $data->raw_quantity ?? null,
        );
    }
}