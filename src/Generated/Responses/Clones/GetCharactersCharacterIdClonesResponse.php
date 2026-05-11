<?php

namespace Seatplus\EsiClient\Generated\Responses\Clones;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdClonesResponse
{
    public function __construct(
        public readonly array $jump_clones,
        public readonly ?GetCharactersCharacterIdClonesResponseHomeLocation $home_location = null,
        public readonly ?string $last_clone_jump_date = null,
        public readonly ?string $last_station_change_date = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            jump_clones: array_map(fn(object $i) => GetCharactersCharacterIdClonesResponseJumpClonesItem::from($i), (array) $data->jump_clones),
            home_location: isset($data->home_location) ? GetCharactersCharacterIdClonesResponseHomeLocation::from($data->home_location) : null,
            last_clone_jump_date: $data->last_clone_jump_date ?? null,
            last_station_change_date: $data->last_station_change_date ?? null,
        );
    }
}