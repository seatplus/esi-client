<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdAlliancehistoryGetItem
{
    public function __construct(
        public readonly int $record_id,
        public readonly string $start_date,
        public readonly ?int $alliance_id = null,
        public readonly ?bool $is_deleted = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            record_id: $data->record_id,
            start_date: $data->start_date,
            alliance_id: $data->alliance_id ?? null,
            is_deleted: $data->is_deleted ?? null,
        );
    }
}