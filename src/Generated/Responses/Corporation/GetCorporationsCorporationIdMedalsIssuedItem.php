<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdMedalsIssuedItem
{
    public function __construct(
        public readonly int $character_id,
        public readonly string $issued_at,
        public readonly int $issuer_id,
        public readonly int $medal_id,
        public readonly string $reason,
        public readonly string $status,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            medal_id: $data->medal_id,
            character_id: $data->character_id,
            reason: $data->reason,
            status: $data->status,
            issuer_id: $data->issuer_id,
            issued_at: $data->issued_at,
        );
    }
}