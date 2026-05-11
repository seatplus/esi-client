<?php

namespace Seatplus\EsiClient\Generated\Responses\Mail;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdMailListsItem
{
    public function __construct(
        public readonly int $mailing_list_id,
        public readonly string $name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            mailing_list_id: $data->mailing_list_id,
            name: $data->name,
        );
    }
}