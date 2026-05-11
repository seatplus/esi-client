<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseStargatesStargateIdResponseDestination
{
    public function __construct(
        public readonly int $stargate_id,
        public readonly int $system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            system_id: $data->system_id,
            stargate_id: $data->stargate_id,
        );
    }
}