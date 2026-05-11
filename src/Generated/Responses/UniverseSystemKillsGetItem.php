<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class UniverseSystemKillsGetItem
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
            npc_kills: $data->npc_kills,
            pod_kills: $data->pod_kills,
            ship_kills: $data->ship_kills,
            system_id: $data->system_id,
        );
    }
}