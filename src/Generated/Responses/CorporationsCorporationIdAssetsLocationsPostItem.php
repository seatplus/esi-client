<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdAssetsLocationsPostItem
{
    public function __construct(
        public readonly int $item_id,
        public readonly mixed $position,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            item_id: $data->item_id,
            position: $data->position,
        );
    }
}