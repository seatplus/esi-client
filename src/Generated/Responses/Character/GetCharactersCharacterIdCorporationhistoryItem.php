<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdCorporationhistoryItem
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
            start_date: $data->start_date,
            corporation_id: $data->corporation_id,
            record_id: $data->record_id,
            is_deleted: $data->is_deleted ?? null,
        );
    }
}