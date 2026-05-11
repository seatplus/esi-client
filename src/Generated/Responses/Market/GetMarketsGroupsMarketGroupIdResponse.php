<?php

namespace Seatplus\EsiClient\Generated\Responses\Market;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetMarketsGroupsMarketGroupIdResponse
{
    public function __construct(
        public readonly string $description,
        public readonly int $market_group_id,
        public readonly string $name,
        public readonly array $types,
        public readonly ?int $parent_group_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            market_group_id: $data->market_group_id,
            name: $data->name,
            description: $data->description,
            types: $data->types,
            parent_group_id: $data->parent_group_id ?? null,
        );
    }
}