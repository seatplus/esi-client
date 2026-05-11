<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdDivisionsGet
{
    public function __construct(
        public readonly ?array $hangar = null,
        public readonly ?array $wallet = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            hangar: isset($data->hangar) ? (array) $data->hangar : null,
            wallet: isset($data->wallet) ? (array) $data->wallet : null,
        );
    }
}