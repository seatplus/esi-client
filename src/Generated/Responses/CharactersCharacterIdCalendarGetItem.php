<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdCalendarGetItem
{
    public function __construct(
        public readonly ?string $event_date = null,
        public readonly ?int $event_id = null,
        public readonly ?string $event_response = null,
        public readonly ?int $importance = null,
        public readonly ?string $title = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            event_date: $data->event_date ?? null,
            event_id: $data->event_id ?? null,
            event_response: $data->event_response ?? null,
            importance: $data->importance ?? null,
            title: $data->title ?? null,
        );
    }
}