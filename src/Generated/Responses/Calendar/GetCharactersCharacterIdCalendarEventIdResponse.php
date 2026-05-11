<?php

namespace Seatplus\EsiClient\Generated\Responses\Calendar;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdCalendarEventIdResponse
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
            event_id: $data->event_id,
            owner_id: $data->owner_id,
            owner_name: $data->owner_name,
            date: $data->date,
            title: $data->title,
            duration: $data->duration,
            importance: $data->importance,
            response: $data->response,
            text: $data->text,
            owner_type: $data->owner_type,
        );
    }
}