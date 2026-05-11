<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersDetail
{
    public function __construct(
        public readonly string $birthday,
        public readonly int $bloodline_id,
        public readonly int $corporation_id,
        public readonly string $gender,
        public readonly string $name,
        public readonly int $race_id,
        public readonly ?int $alliance_id = null,
        public readonly ?string $description = null,
        public readonly ?int $faction_id = null,
        public readonly ?float $security_status = null,
        public readonly ?string $title = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            birthday: (string) ($data->birthday ?? ''),
            bloodline_id: (int) ($data->bloodline_id ?? 0),
            corporation_id: (int) ($data->corporation_id ?? 0),
            gender: (string) ($data->gender ?? ''),
            name: (string) ($data->name ?? ''),
            race_id: (int) ($data->race_id ?? 0),
            alliance_id: $data->alliance_id ?? null,
            description: $data->description ?? null,
            faction_id: $data->faction_id ?? null,
            security_status: $data->security_status ?? null,
            title: $data->title ?? null,
        );
    }
}