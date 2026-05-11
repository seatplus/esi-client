<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class DogmaEffectsEffectIdGet
{
    public function __construct(
        public readonly int $effect_id,
        public readonly ?string $description = null,
        public readonly ?bool $disallow_auto_repeat = null,
        public readonly ?int $discharge_attribute_id = null,
        public readonly ?string $display_name = null,
        public readonly ?int $duration_attribute_id = null,
        public readonly ?int $effect_category = null,
        public readonly ?bool $electronic_chance = null,
        public readonly ?int $falloff_attribute_id = null,
        public readonly ?int $icon_id = null,
        public readonly ?bool $is_assistance = null,
        public readonly ?bool $is_offensive = null,
        public readonly ?bool $is_warp_safe = null,
        public readonly ?array $modifiers = null,
        public readonly ?string $name = null,
        public readonly ?int $post_expression = null,
        public readonly ?int $pre_expression = null,
        public readonly ?bool $published = null,
        public readonly ?int $range_attribute_id = null,
        public readonly ?bool $range_chance = null,
        public readonly ?int $tracking_speed_attribute_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            effect_id: (int) ($data->effect_id ?? 0),
            description: $data->description ?? null,
            disallow_auto_repeat: $data->disallow_auto_repeat ?? null,
            discharge_attribute_id: $data->discharge_attribute_id ?? null,
            display_name: $data->display_name ?? null,
            duration_attribute_id: $data->duration_attribute_id ?? null,
            effect_category: $data->effect_category ?? null,
            electronic_chance: $data->electronic_chance ?? null,
            falloff_attribute_id: $data->falloff_attribute_id ?? null,
            icon_id: $data->icon_id ?? null,
            is_assistance: $data->is_assistance ?? null,
            is_offensive: $data->is_offensive ?? null,
            is_warp_safe: $data->is_warp_safe ?? null,
            modifiers: isset($data->modifiers) ? (array) $data->modifiers : null,
            name: $data->name ?? null,
            post_expression: $data->post_expression ?? null,
            pre_expression: $data->pre_expression ?? null,
            published: $data->published ?? null,
            range_attribute_id: $data->range_attribute_id ?? null,
            range_chance: $data->range_chance ?? null,
            tracking_speed_attribute_id: $data->tracking_speed_attribute_id ?? null,
        );
    }
}