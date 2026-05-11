<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdFittingsPost
{
    public function __construct(
        public readonly int $fitting_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            fitting_id: $data->fitting_id,
        );
    }
}