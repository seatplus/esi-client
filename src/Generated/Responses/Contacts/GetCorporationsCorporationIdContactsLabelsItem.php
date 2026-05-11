<?php

namespace Seatplus\EsiClient\Generated\Responses\Contacts;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdContactsLabelsItem
{
    public function __construct(
        public readonly int $label_id,
        public readonly string $label_name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            label_id: $data->label_id,
            label_name: $data->label_name,
        );
    }
}