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
            npc_kills: (int) ($data->npc_kills ?? 0),
            pod_kills: (int) ($data->pod_kills ?? 0),
            ship_kills: (int) ($data->ship_kills ?? 0),
            system_id: (int) ($data->system_id ?? 0),
        );
    }
}