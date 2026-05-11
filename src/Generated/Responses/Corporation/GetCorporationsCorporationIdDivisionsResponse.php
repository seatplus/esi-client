<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdDivisionsResponse
{
    public function __construct(
        public readonly ?array $hangar = null,
        public readonly ?array $wallet = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            hangar: isset($data->hangar) ? array_map(fn(object $i) => GetCorporationsCorporationIdDivisionsResponseHangarItem::from($i), (array) $data->hangar) : null,
            wallet: isset($data->wallet) ? array_map(fn(object $i) => GetCorporationsCorporationIdDivisionsResponseWalletItem::from($i), (array) $data->wallet) : null,
        );
    }
}