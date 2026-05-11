<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdContractsGetItem
{
    public function __construct(
        public readonly int $acceptor_id,
        public readonly int $assignee_id,
        public readonly string $availability,
        public readonly int $contract_id,
        public readonly string $date_expired,
        public readonly string $date_issued,
        public readonly bool $for_corporation,
        public readonly int $issuer_corporation_id,
        public readonly int $issuer_id,
        public readonly string $status,
        public readonly string $type,
        public readonly ?float $buyout = null,
        public readonly ?float $collateral = null,
        public readonly ?string $date_accepted = null,
        public readonly ?string $date_completed = null,
        public readonly ?int $days_to_complete = null,
        public readonly ?int $end_location_id = null,
        public readonly ?float $price = null,
        public readonly ?float $reward = null,
        public readonly ?int $start_location_id = null,
        public readonly ?string $title = null,
        public readonly ?float $volume = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            acceptor_id: $data->acceptor_id,
            assignee_id: $data->assignee_id,
            availability: $data->availability,
            contract_id: $data->contract_id,
            date_expired: $data->date_expired,
            date_issued: $data->date_issued,
            for_corporation: $data->for_corporation,
            issuer_corporation_id: $data->issuer_corporation_id,
            issuer_id: $data->issuer_id,
            status: $data->status,
            type: $data->type,
            buyout: $data->buyout ?? null,
            collateral: $data->collateral ?? null,
            date_accepted: $data->date_accepted ?? null,
            date_completed: $data->date_completed ?? null,
            days_to_complete: $data->days_to_complete ?? null,
            end_location_id: $data->end_location_id ?? null,
            price: $data->price ?? null,
            reward: $data->reward ?? null,
            start_location_id: $data->start_location_id ?? null,
            title: $data->title ?? null,
            volume: $data->volume ?? null,
        );
    }
}