<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdNotificationsContactsGetItem
{
    public function __construct(
        public readonly string $message,
        public readonly int $notification_id,
        public readonly string $send_date,
        public readonly int $sender_character_id,
        public readonly float $standing_level,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            message: $data->message,
            notification_id: $data->notification_id,
            send_date: $data->send_date,
            sender_character_id: $data->sender_character_id,
            standing_level: $data->standing_level,
        );
    }
}