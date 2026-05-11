<?php

namespace Seatplus\EsiClient\Generated\Responses\Clones;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdClonesResponseJumpClonesItem
{
    public function __construct(
        public readonly array $implants,
        public readonly int $jump_clone_id,
        public readonly int $location_id,
        public readonly string $location_type,
        public readonly ?string $name = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            jump_clone_id: $data->jump_clone_id,
            location_id: $data->location_id,
            location_type: $data->location_type,
            implants: $data->implants,
            name: $data->name ?? null,
        );
    }
}