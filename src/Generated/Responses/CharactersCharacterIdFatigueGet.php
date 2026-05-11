<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdFatigueGet
{
    public function __construct(
        public readonly ?string $jump_fatigue_expire_date = null,
        public readonly ?string $last_jump_date = null,
        public readonly ?string $last_update_date = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            jump_fatigue_expire_date: $data->jump_fatigue_expire_date ?? null,
            last_jump_date: $data->last_jump_date ?? null,
            last_update_date: $data->last_update_date ?? null,
        );
    }
}