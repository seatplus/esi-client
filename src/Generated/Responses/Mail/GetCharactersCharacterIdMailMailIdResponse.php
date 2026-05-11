<?php

namespace Seatplus\EsiClient\Generated\Responses\Mail;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdMailMailIdResponse
{
    public function __construct(
        public readonly ?string $body = null,
        public readonly ?int $from = null,
        public readonly ?array $labels = null,
        public readonly ?bool $read = null,
        public readonly ?array $recipients = null,
        public readonly ?string $subject = null,
        public readonly ?string $timestamp = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            body: $data->body ?? null,
            from: $data->from ?? null,
            labels: $data->labels ?? null,
            read: $data->read ?? null,
            recipients: isset($data->recipients) ? array_map(fn(object $i) => GetCharactersCharacterIdMailMailIdResponseRecipientsItem::from($i), (array) $data->recipients) : null,
            subject: $data->subject ?? null,
            timestamp: $data->timestamp ?? null,
        );
    }
}