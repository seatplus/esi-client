<?php

namespace Seatplus\EsiClient\Generated\Responses\Clones;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdClonesResponseHomeLocation
{
    public function __construct(
        public readonly ?int $location_id = null,
        public readonly ?string $location_type = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            location_id: $data->location_id ?? null,
            location_type: $data->location_type ?? null,
        );
    }
}