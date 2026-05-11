<?php

namespace Seatplus\EsiClient\Generated\Responses\Skills;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdAttributesResponse
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
            charisma: $data->charisma,
            intelligence: $data->intelligence,
            memory: $data->memory,
            perception: $data->perception,
            willpower: $data->willpower,
            accrued_remap_cooldown_date: $data->accrued_remap_cooldown_date ?? null,
            bonus_remaps: $data->bonus_remaps ?? null,
            last_remap_date: $data->last_remap_date ?? null,
        );
    }
}