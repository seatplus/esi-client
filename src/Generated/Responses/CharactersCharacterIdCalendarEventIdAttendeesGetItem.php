<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdCalendarEventIdAttendeesGetItem
{
    public function __construct(
        public readonly ?int $character_id = null,
        public readonly ?string $event_response = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character_id: $data->character_id ?? null,
            event_response: $data->event_response ?? null,
        );
    }
}