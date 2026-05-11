<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class DogmaAttributesAttributeIdGet
{
    public function __construct(
        public readonly int $attribute_id,
        public readonly ?float $default_value = null,
        public readonly ?string $description = null,
        public readonly ?string $display_name = null,
        public readonly ?bool $high_is_good = null,
        public readonly ?int $icon_id = null,
        public readonly ?string $name = null,
        public readonly ?bool $published = null,
        public readonly ?bool $stackable = null,
        public readonly ?int $unit_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            attribute_id: (int) ($data->attribute_id ?? 0),
            default_value: $data->default_value ?? null,
            description: $data->description ?? null,
            display_name: $data->display_name ?? null,
            high_is_good: $data->high_is_good ?? null,
            icon_id: $data->icon_id ?? null,
            name: $data->name ?? null,
            published: $data->published ?? null,
            stackable: $data->stackable ?? null,
            unit_id: $data->unit_id ?? null,
        );
    }
}