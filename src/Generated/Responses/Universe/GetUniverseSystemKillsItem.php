<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseSystemKillsItem
{
    public function __construct(
        public readonly int $npc_kills,
        public readonly int $pod_kills,
        public readonly int $ship_kills,
        public readonly int $system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            system_id: $data->system_id,
            ship_kills: $data->ship_kills,
            npc_kills: $data->npc_kills,
            pod_kills: $data->pod_kills,
        );
    }
}