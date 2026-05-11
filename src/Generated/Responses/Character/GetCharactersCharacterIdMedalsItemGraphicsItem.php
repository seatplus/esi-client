<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdMedalsItemGraphicsItem
{
    public function __construct(
        public readonly string $graphic,
        public readonly int $layer,
        public readonly int $part,
        public readonly ?int $color = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            part: $data->part,
            layer: $data->layer,
            graphic: $data->graphic,
            color: $data->color ?? null,
        );
    }
}