<?php

namespace Seatplus\EsiClient\Generated\Responses\Mail;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdMailItem
{
    public function __construct(
        public readonly ?int $from = null,
        public readonly ?bool $is_read = null,
        public readonly ?array $labels = null,
        public readonly ?int $mail_id = null,
        public readonly ?array $recipients = null,
        public readonly ?string $subject = null,
        public readonly ?string $timestamp = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            from: $data->from ?? null,
            is_read: $data->is_read ?? null,
            labels: $data->labels ?? null,
            mail_id: $data->mail_id ?? null,
            recipients: isset($data->recipients) ? array_map(fn(object $i) => GetCharactersCharacterIdMailItemRecipientsItem::from($i), (array) $data->recipients) : null,
            subject: $data->subject ?? null,
            timestamp: $data->timestamp ?? null,
        );
    }
}