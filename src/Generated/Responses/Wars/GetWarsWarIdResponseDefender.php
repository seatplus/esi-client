<?php

namespace Seatplus\EsiClient\Generated\Responses\Wars;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetWarsWarIdResponseDefender
{
    public function __construct(
        public readonly float $isk_destroyed,
        public readonly int $ships_killed,
        public readonly ?int $alliance_id = null,
        public readonly ?int $corporation_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            ships_killed: $data->ships_killed,
            isk_destroyed: $data->isk_destroyed,
            alliance_id: $data->alliance_id ?? null,
            corporation_id: $data->corporation_id ?? null,
        );
    }
}