<?php

namespace Seatplus\EsiClient\Generated\Responses\Mail;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdMailLabelsResponseLabelsItem
{
    public function __construct(
        public readonly ?string $color = null,
        public readonly ?int $label_id = null,
        public readonly ?string $name = null,
        public readonly ?int $unread_count = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            color: $data->color ?? null,
            label_id: $data->label_id ?? null,
            name: $data->name ?? null,
            unread_count: $data->unread_count ?? null,
        );
    }
}