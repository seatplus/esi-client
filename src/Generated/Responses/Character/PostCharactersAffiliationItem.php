<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class PostCharactersAffiliationItem
{
    public function __construct(
        public readonly int $character_id,
        public readonly int $corporation_id,
        public readonly ?int $alliance_id = null,
        public readonly ?int $faction_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character_id: $data->character_id,
            corporation_id: $data->corporation_id,
            alliance_id: $data->alliance_id ?? null,
            faction_id: $data->faction_id ?? null,
        );
    }
}