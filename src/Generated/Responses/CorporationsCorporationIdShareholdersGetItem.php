<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdShareholdersGetItem
{
    public function __construct(
        public readonly int $share_count,
        public readonly int $shareholder_id,
        public readonly string $shareholder_type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            share_count: (int) ($data->share_count ?? 0),
            shareholder_id: (int) ($data->shareholder_id ?? 0),
            shareholder_type: (string) ($data->shareholder_type ?? ''),
        );
    }
}