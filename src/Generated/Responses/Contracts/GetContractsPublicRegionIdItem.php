<?php

namespace Seatplus\EsiClient\Generated\Responses\Contracts;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetContractsPublicRegionIdItem
{
    public function __construct(
        public readonly int $contract_id,
        public readonly string $date_expired,
        public readonly string $date_issued,
        public readonly int $issuer_corporation_id,
        public readonly int $issuer_id,
        public readonly string $type,
        public readonly ?float $buyout = null,
        public readonly ?float $collateral = null,
        public readonly ?int $days_to_complete = null,
        public readonly ?int $end_location_id = null,
        public readonly ?bool $for_corporation = null,
        public readonly ?float $price = null,
        public readonly ?float $reward = null,
        public readonly ?int $start_location_id = null,
        public readonly ?string $title = null,
        public readonly ?float $volume = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            contract_id: $data->contract_id,
            issuer_id: $data->issuer_id,
            issuer_corporation_id: $data->issuer_corporation_id,
            type: $data->type,
            date_issued: $data->date_issued,
            date_expired: $data->date_expired,
            buyout: $data->buyout ?? null,
            collateral: $data->collateral ?? null,
            days_to_complete: $data->days_to_complete ?? null,
            end_location_id: $data->end_location_id ?? null,
            for_corporation: $data->for_corporation ?? null,
            price: $data->price ?? null,
            reward: $data->reward ?? null,
            start_location_id: $data->start_location_id ?? null,
            title: $data->title ?? null,
            volume: $data->volume ?? null,
        );
    }
}