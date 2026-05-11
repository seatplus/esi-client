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
            created_at: (string) ($data->created_at ?? ''),
            creator_id: (int) ($data->creator_id ?? 0),
            description: (string) ($data->description ?? ''),
            medal_id: (int) ($data->medal_id ?? 0),
            title: (string) ($data->title ?? ''),
        );
    }
}