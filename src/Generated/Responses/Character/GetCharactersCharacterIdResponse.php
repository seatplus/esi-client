<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdResponse
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
            corporation_id: $data->corporation_id,
            birthday: $data->birthday,
            name: $data->name,
            gender: $data->gender,
            race_id: $data->race_id,
            bloodline_id: $data->bloodline_id,
            alliance_id: $data->alliance_id ?? null,
            description: $data->description ?? null,
            faction_id: $data->faction_id ?? null,
            security_status: $data->security_status ?? null,
            title: $data->title ?? null,
        );
    }
}