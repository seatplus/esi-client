<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationCorporationIdMiningObserversObserverIdGetItem
{
    public function __construct(
        public readonly int $character_id,
        public readonly string $last_updated,
        public readonly int $quantity,
        public readonly int $recorded_corporation_id,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character_id: $data->character_id,
            last_updated: $data->last_updated,
            quantity: $data->quantity,
            recorded_corporation_id: $data->recorded_corporation_id,
            type_id: $data->type_id,
        );
    }
}