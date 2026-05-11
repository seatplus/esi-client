<?php

namespace Seatplus\EsiClient\Generated\Responses\Dogma;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetDogmaEffectsEffectIdResponseModifiersItem
{
    public function __construct(
        public readonly string $func,
        public readonly ?string $domain = null,
        public readonly ?int $effect_id = null,
        public readonly ?int $modified_attribute_id = null,
        public readonly ?int $modifying_attribute_id = null,
        public readonly ?int $operator = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            func: $data->func,
            domain: $data->domain ?? null,
            effect_id: $data->effect_id ?? null,
            modified_attribute_id: $data->modified_attribute_id ?? null,
            modifying_attribute_id: $data->modifying_attribute_id ?? null,
            operator: $data->operator ?? null,
        );
    }
}