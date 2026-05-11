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
            character_id: (int) ($data->character_id ?? 0),
            last_updated: (string) ($data->last_updated ?? ''),
            quantity: (int) ($data->quantity ?? 0),
            recorded_corporation_id: (int) ($data->recorded_corporation_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
        );
    }
}