<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdMedalsIssuedGetItem
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
            character_id: $data->character_id,
            issued_at: $data->issued_at,
            issuer_id: $data->issuer_id,
            medal_id: $data->medal_id,
            reason: $data->reason,
            status: $data->status,
        );
    }
}