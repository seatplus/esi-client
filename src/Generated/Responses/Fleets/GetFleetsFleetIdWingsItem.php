<?php

namespace Seatplus\EsiClient\Generated\Responses\Fleets;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFleetsFleetIdWingsItem
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly array $squads,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name,
            id: $data->id,
            squads: array_map(fn(object $i) => GetFleetsFleetIdWingsItemSquadsItem::from($i), (array) $data->squads),
        );
    }
}