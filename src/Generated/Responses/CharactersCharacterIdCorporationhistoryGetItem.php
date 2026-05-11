<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdCorporationhistoryGetItem
{
    public function __construct(
        public readonly int $corporation_id,
        public readonly int $record_id,
        public readonly string $start_date,
        public readonly ?bool $is_deleted = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            corporation_id: (int) ($data->corporation_id ?? 0),
            record_id: (int) ($data->record_id ?? 0),
            start_date: (string) ($data->start_date ?? ''),
            is_deleted: $data->is_deleted ?? null,
        );
    }
}