<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdDivisionsResponseHangarItem
{
    public function __construct(
        public readonly ?int $division = null,
        public readonly ?string $name = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            division: $data->division ?? null,
            name: $data->name ?? null,
        );
    }
}