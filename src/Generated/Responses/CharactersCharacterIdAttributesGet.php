<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdAttributesGet
{
    public function __construct(
        public readonly int $charisma,
        public readonly int $intelligence,
        public readonly int $memory,
        public readonly int $perception,
        public readonly int $willpower,
        public readonly ?string $accrued_remap_cooldown_date = null,
        public readonly ?int $bonus_remaps = null,
        public readonly ?string $last_remap_date = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            charisma: (int) ($data->charisma ?? 0),
            intelligence: (int) ($data->intelligence ?? 0),
            memory: (int) ($data->memory ?? 0),
            perception: (int) ($data->perception ?? 0),
            willpower: (int) ($data->willpower ?? 0),
            accrued_remap_cooldown_date: $data->accrued_remap_cooldown_date ?? null,
            bonus_remaps: $data->bonus_remaps ?? null,
            last_remap_date: $data->last_remap_date ?? null,
        );
    }
}