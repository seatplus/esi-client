<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdTitlesItem
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