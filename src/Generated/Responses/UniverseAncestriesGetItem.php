<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseAncestriesGetItem
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
            bloodline_id: (int) ($data->bloodline_id ?? 0),
            description: (string) ($data->description ?? ''),
            id: (int) ($data->id ?? 0),
            name: (string) ($data->name ?? ''),
            icon_id: $data->icon_id ?? null,
            short_description: $data->short_description ?? null,
        );
    }
}