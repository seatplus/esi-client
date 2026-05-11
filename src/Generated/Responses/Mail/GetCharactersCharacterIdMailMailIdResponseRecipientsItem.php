<?php

namespace Seatplus\EsiClient\Generated\Responses\Mail;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdMailMailIdResponseRecipientsItem
{
    public function __construct(
        public readonly int $recipient_id,
        public readonly string $recipient_type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            recipient_type: $data->recipient_type,
            recipient_id: $data->recipient_id,
        );
    }
}