<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class AllianceDetail
{
    public function __construct(
        public readonly int $creator_corporation_id,
        public readonly int $creator_id,
        public readonly string $date_founded,
        public readonly string $name,
        public readonly string $ticker,
        public readonly ?int $executor_corporation_id = null,
        public readonly ?int $faction_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            creator_corporation_id: $data->creator_corporation_id,
            creator_id: $data->creator_id,
            date_founded: $data->date_founded,
            name: $data->name,
            ticker: $data->ticker,
            executor_corporation_id: $data->executor_corporation_id ?? null,
            faction_id: $data->faction_id ?? null,
        );
    }
}