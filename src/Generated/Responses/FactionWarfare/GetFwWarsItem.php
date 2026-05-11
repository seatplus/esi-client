<?php

namespace Seatplus\EsiClient\Generated\Responses\FactionWarfare;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFwWarsItem
{
    public function __construct(
        public readonly int $against_id,
        public readonly int $faction_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            faction_id: $data->faction_id,
            against_id: $data->against_id,
        );
    }
}