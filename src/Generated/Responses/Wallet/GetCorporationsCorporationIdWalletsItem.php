<?php

namespace Seatplus\EsiClient\Generated\Responses\Wallet;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdWalletsItem
{
    public function __construct(
        public readonly float $balance,
        public readonly int $division,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            division: $data->division,
            balance: $data->balance,
        );
    }
}