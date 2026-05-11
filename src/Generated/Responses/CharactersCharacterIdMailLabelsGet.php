<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdMailLabelsGet
{
    public function __construct(
        public readonly ?array $labels = null,
        public readonly ?int $total_unread_count = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            labels: isset($data->labels) ? (array) $data->labels : null,
            total_unread_count: $data->total_unread_count ?? null,
        );
    }
}