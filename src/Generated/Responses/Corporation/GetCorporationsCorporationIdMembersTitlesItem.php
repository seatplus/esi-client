<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdMembersTitlesItem
{
    public function __construct(
        public readonly int $character_id,
        public readonly array $titles,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character_id: $data->character_id,
            titles: $data->titles,
        );
    }
}