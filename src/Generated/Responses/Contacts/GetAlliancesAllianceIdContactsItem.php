<?php

namespace Seatplus\EsiClient\Generated\Responses\Contacts;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetAlliancesAllianceIdContactsItem
{
    public function __construct(
        public readonly int $contact_id,
        public readonly string $contact_type,
        public readonly float $standing,
        public readonly ?array $label_ids = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            standing: $data->standing,
            contact_type: $data->contact_type,
            contact_id: $data->contact_id,
            label_ids: $data->label_ids ?? null,
        );
    }
}