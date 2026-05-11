<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdMailListsGetItem
{
    public function __construct(
        public readonly int $mailing_list_id,
        public readonly string $name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            mailing_list_id: (int) ($data->mailing_list_id ?? 0),
            name: (string) ($data->name ?? ''),
        );
    }
}