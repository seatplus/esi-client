<?php

namespace Seatplus\EsiClient\Generated\Responses\Contracts;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetContractsPublicItemsContractIdItem
{
    public function __construct(
        public readonly bool $is_included,
        public readonly int $quantity,
        public readonly int $record_id,
        public readonly int $type_id,
        public readonly ?bool $is_blueprint_copy = null,
        public readonly ?int $item_id = null,
        public readonly ?int $material_efficiency = null,
        public readonly ?int $runs = null,
        public readonly ?int $time_efficiency = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            record_id: $data->record_id,
            type_id: $data->type_id,
            quantity: $data->quantity,
            is_included: $data->is_included,
            is_blueprint_copy: $data->is_blueprint_copy ?? null,
            item_id: $data->item_id ?? null,
            material_efficiency: $data->material_efficiency ?? null,
            runs: $data->runs ?? null,
            time_efficiency: $data->time_efficiency ?? null,
        );
    }
}