<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseStargatesStargateIdResponse
{
    public function __construct(
        public readonly GetUniverseStargatesStargateIdResponseDestination $destination,
        public readonly string $name,
        public readonly GetUniverseStargatesStargateIdResponsePosition $position,
        public readonly int $stargate_id,
        public readonly int $system_id,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            stargate_id: $data->stargate_id,
            name: $data->name,
            type_id: $data->type_id,
            position: GetUniverseStargatesStargateIdResponsePosition::from($data->position),
            system_id: $data->system_id,
            destination: GetUniverseStargatesStargateIdResponseDestination::from($data->destination),
        );
    }
}