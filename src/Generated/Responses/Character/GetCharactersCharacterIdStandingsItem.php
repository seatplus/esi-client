<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdStandingsItem
{
    public function __construct(
        public readonly int $from_id,
        public readonly string $from_type,
        public readonly float $standing,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            from_id: $data->from_id,
            from_type: $data->from_type,
            standing: $data->standing,
        );
    }
}