<?php

namespace Seatplus\EsiClient\Generated\Responses\Assets;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class PostCorporationsCorporationIdAssetsNamesItem
{
    public function __construct(
        public readonly int $item_id,
        public readonly string $name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            item_id: $data->item_id,
            name: $data->name,
        );
    }
}