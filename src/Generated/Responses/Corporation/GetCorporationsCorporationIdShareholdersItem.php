<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdShareholdersItem
{
    public function __construct(
        public readonly int $share_count,
        public readonly int $shareholder_id,
        public readonly string $shareholder_type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            shareholder_id: $data->shareholder_id,
            shareholder_type: $data->shareholder_type,
            share_count: $data->share_count,
        );
    }
}