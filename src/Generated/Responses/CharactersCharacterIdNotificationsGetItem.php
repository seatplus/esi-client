<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdNotificationsGetItem
{
    public function __construct(
        public readonly int $notification_id,
        public readonly int $sender_id,
        public readonly string $sender_type,
        public readonly string $timestamp,
        public readonly string $type,
        public readonly ?bool $is_read = null,
        public readonly ?string $text = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            notification_id: $data->notification_id,
            sender_id: $data->sender_id,
            sender_type: $data->sender_type,
            timestamp: $data->timestamp,
            type: $data->type,
            is_read: $data->is_read ?? null,
            text: $data->text ?? null,
        );
    }
}