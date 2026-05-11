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
            character_id: (int) ($data->character_id ?? 0),
            issued_at: (string) ($data->issued_at ?? ''),
            issuer_id: (int) ($data->issuer_id ?? 0),
            medal_id: (int) ($data->medal_id ?? 0),
            reason: (string) ($data->reason ?? ''),
            status: (string) ($data->status ?? ''),
        );
    }
}