<?php

namespace Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemExtractorDetails
{
    public function __construct(
        public readonly array $heads,
        public readonly ?int $cycle_time = null,
        public readonly ?float $head_radius = null,
        public readonly ?int $product_type_id = null,
        public readonly ?int $qty_per_cycle = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            heads: array_map(fn(object $i) => GetCharactersCharacterIdPlanetsPlanetIdResponsePinsItemExtractorDetailsHeadsItem::from($i), (array) $data->heads),
            cycle_time: $data->cycle_time ?? null,
            head_radius: $data->head_radius ?? null,
            product_type_id: $data->product_type_id ?? null,
            qty_per_cycle: $data->qty_per_cycle ?? null,
        );
    }
}