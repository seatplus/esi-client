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
            corporation_id: (int) ($data->corporation_id ?? 0),
            date: (string) ($data->date ?? ''),
            description: (string) ($data->description ?? ''),
            graphics: (array) ($data->graphics ?? []),
            issuer_id: (int) ($data->issuer_id ?? 0),
            medal_id: (int) ($data->medal_id ?? 0),
            reason: (string) ($data->reason ?? ''),
            status: (string) ($data->status ?? ''),
            title: (string) ($data->title ?? ''),
        );
    }
}