<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseMoonsMoonIdResponsePosition
{
    public function __construct(
        public readonly float $x,
        public readonly float $y,
        public readonly float $z,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            x: $data->x,
            y: $data->y,
            z: $data->z,
        );
    }
}