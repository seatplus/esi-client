<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdContactsLabelsGetItem
{
    public function __construct(
        public readonly int $label_id,
        public readonly string $label_name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            label_id: (int) ($data->label_id ?? 0),
            label_name: (string) ($data->label_name ?? ''),
        );
    }
}