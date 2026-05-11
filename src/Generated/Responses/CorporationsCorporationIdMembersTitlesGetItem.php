<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdMembersTitlesGetItem
{
    public function __construct(
        public readonly int $character_id,
        public readonly array $titles,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character_id: (int) ($data->character_id ?? 0),
            titles: (array) ($data->titles ?? []),
        );
    }
}