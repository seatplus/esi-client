<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdCalendarEventIdGet
{
    public function __construct(
        public readonly string $date,
        public readonly int $duration,
        public readonly int $event_id,
        public readonly int $importance,
        public readonly int $owner_id,
        public readonly string $owner_name,
        public readonly string $owner_type,
        public readonly string $response,
        public readonly string $text,
        public readonly string $title,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            date: (string) ($data->date ?? ''),
            duration: (int) ($data->duration ?? 0),
            event_id: (int) ($data->event_id ?? 0),
            importance: (int) ($data->importance ?? 0),
            owner_id: (int) ($data->owner_id ?? 0),
            owner_name: (string) ($data->owner_name ?? ''),
            owner_type: (string) ($data->owner_type ?? ''),
            response: (string) ($data->response ?? ''),
            text: (string) ($data->text ?? ''),
            title: (string) ($data->title ?? ''),
        );
    }
}