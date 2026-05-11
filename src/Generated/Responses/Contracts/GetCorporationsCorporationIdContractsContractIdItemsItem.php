<?php

namespace Seatplus\EsiClient\Generated\Responses\Contracts;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdContractsContractIdItemsItem
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
            record_id: $data->record_id,
            type_id: $data->type_id,
            quantity: $data->quantity,
            is_singleton: $data->is_singleton,
            is_included: $data->is_included,
            raw_quantity: $data->raw_quantity ?? null,
        );
    }
}