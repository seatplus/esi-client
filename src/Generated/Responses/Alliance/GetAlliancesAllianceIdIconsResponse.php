<?php

namespace Seatplus\EsiClient\Generated\Responses\Alliance;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetAlliancesAllianceIdIconsResponse
{
    public function __construct(
        public readonly ?string $px128x128 = null,
        public readonly ?string $px64x64 = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            px128x128: $data->px128x128 ?? null,
            px64x64: $data->px64x64 ?? null,
        );
    }
}