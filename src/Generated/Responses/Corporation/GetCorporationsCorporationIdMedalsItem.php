<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdMedalsItem
{
    public function __construct(
        public readonly string $created_at,
        public readonly int $creator_id,
        public readonly string $description,
        public readonly int $medal_id,
        public readonly string $title,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            medal_id: $data->medal_id,
            title: $data->title,
            description: $data->description,
            creator_id: $data->creator_id,
            created_at: $data->created_at,
        );
    }
}