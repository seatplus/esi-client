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
            share_count: $data->share_count,
            shareholder_id: $data->shareholder_id,
            shareholder_type: $data->shareholder_type,
        );
    }
}