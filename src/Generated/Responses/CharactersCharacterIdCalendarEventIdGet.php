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
            date: $data->date,
            duration: $data->duration,
            event_id: $data->event_id,
            importance: $data->importance,
            owner_id: $data->owner_id,
            owner_name: $data->owner_name,
            owner_type: $data->owner_type,
            response: $data->response,
            text: $data->text,
            title: $data->title,
        );
    }
}