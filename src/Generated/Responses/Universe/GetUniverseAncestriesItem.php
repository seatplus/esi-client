<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseAncestriesItem
{
    public function __construct(
        public readonly int $bloodline_id,
        public readonly string $description,
        public readonly int $id,
        public readonly string $name,
        public readonly ?int $icon_id = null,
        public readonly ?string $short_description = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            id: $data->id,
            name: $data->name,
            bloodline_id: $data->bloodline_id,
            description: $data->description,
            icon_id: $data->icon_id ?? null,
            short_description: $data->short_description ?? null,
        );
    }
}