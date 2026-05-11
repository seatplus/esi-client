<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPortraitResponse
{
    public function __construct(
        public readonly ?string $px128x128 = null,
        public readonly ?string $px256x256 = null,
        public readonly ?string $px512x512 = null,
        public readonly ?string $px64x64 = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            px128x128: $data->px128x128 ?? null,
            px256x256: $data->px256x256 ?? null,
            px512x512: $data->px512x512 ?? null,
            px64x64: $data->px64x64 ?? null,
        );
    }
}