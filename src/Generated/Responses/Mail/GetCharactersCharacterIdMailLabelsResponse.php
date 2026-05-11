<?php

namespace Seatplus\EsiClient\Generated\Responses\Mail;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdMailLabelsResponse
{
    public function __construct(
        public readonly ?array $labels = null,
        public readonly ?int $total_unread_count = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            labels: isset($data->labels) ? array_map(fn(object $i) => GetCharactersCharacterIdMailLabelsResponseLabelsItem::from($i), (array) $data->labels) : null,
            total_unread_count: $data->total_unread_count ?? null,
        );
    }
}