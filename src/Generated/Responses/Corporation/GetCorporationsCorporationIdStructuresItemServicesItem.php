<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdStructuresItemServicesItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $state,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name,
            state: $data->state,
        );
    }
}