<?php

namespace Seatplus\EsiClient\Generated\Responses\Sovereignty;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetSovereigntyMapItem
{
    public function __construct(
        public readonly int $system_id,
        public readonly ?int $alliance_id = null,
        public readonly ?int $corporation_id = null,
        public readonly ?int $faction_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            system_id: $data->system_id,
            alliance_id: $data->alliance_id ?? null,
            corporation_id: $data->corporation_id ?? null,
            faction_id: $data->faction_id ?? null,
        );
    }
}