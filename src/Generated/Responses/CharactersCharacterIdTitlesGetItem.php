<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdTitlesGetItem
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?int $title_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name ?? null,
            title_id: $data->title_id ?? null,
        );
    }
}