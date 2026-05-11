<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdContactsGetItem
{
    public function __construct(
        public readonly int $contact_id,
        public readonly string $contact_type,
        public readonly float $standing,
        public readonly ?bool $is_watched = null,
        public readonly ?array $label_ids = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            contact_id: $data->contact_id,
            contact_type: $data->contact_type,
            standing: $data->standing,
            is_watched: $data->is_watched ?? null,
            label_ids: isset($data->label_ids) ? (array) $data->label_ids : null,
        );
    }
}