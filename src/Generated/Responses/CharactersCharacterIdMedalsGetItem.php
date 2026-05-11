<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdMedalsGetItem
{
    public function __construct(
        public readonly int $corporation_id,
        public readonly string $date,
        public readonly string $description,
        public readonly array $graphics,
        public readonly int $issuer_id,
        public readonly int $medal_id,
        public readonly string $reason,
        public readonly string $status,
        public readonly string $title,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            corporation_id: $data->corporation_id,
            date: $data->date,
            description: $data->description,
            graphics: (array) ($data->graphics ?? []),
            issuer_id: $data->issuer_id,
            medal_id: $data->medal_id,
            reason: $data->reason,
            status: $data->status,
            title: $data->title,
        );
    }
}