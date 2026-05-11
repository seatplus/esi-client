<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdMedalsItem
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
            medal_id: $data->medal_id,
            title: $data->title,
            description: $data->description,
            corporation_id: $data->corporation_id,
            issuer_id: $data->issuer_id,
            date: $data->date,
            reason: $data->reason,
            status: $data->status,
            graphics: array_map(fn(object $i) => GetCharactersCharacterIdMedalsItemGraphicsItem::from($i), (array) $data->graphics),
        );
    }
}