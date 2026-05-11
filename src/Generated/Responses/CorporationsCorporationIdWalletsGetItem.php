<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdWalletsGetItem
{
    public function __construct(
        public readonly float $balance,
        public readonly int $division,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            balance: $data->balance,
            division: $data->division,
        );
    }
}