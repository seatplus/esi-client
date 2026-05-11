<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdMedalsGetItem
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
            created_at: $data->created_at,
            creator_id: $data->creator_id,
            description: $data->description,
            medal_id: $data->medal_id,
            title: $data->title,
        );
    }
}