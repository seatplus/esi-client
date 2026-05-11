<?php

namespace Seatplus\EsiClient\Generated\Responses\Fleets;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFleetsFleetIdWingsItemSquadsItem
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name,
            id: $data->id,
        );
    }
}