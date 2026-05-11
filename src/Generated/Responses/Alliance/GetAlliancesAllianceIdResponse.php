<?php

namespace Seatplus\EsiClient\Generated\Responses\Alliance;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetAlliancesAllianceIdResponse
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
            name: $data->name,
            creator_id: $data->creator_id,
            creator_corporation_id: $data->creator_corporation_id,
            ticker: $data->ticker,
            date_founded: $data->date_founded,
            executor_corporation_id: $data->executor_corporation_id ?? null,
            faction_id: $data->faction_id ?? null,
        );
    }
}