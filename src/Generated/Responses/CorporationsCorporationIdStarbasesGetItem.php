<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdStarbasesGetItem
{
    public function __construct(
        public readonly int $starbase_id,
        public readonly int $system_id,
        public readonly int $type_id,
        public readonly ?int $moon_id = null,
        public readonly ?string $onlined_since = null,
        public readonly ?string $reinforced_until = null,
        public readonly ?string $state = null,
        public readonly ?string $unanchor_at = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            starbase_id: (int) ($data->starbase_id ?? 0),
            system_id: (int) ($data->system_id ?? 0),
            type_id: (int) ($data->type_id ?? 0),
            moon_id: $data->moon_id ?? null,
            onlined_since: $data->onlined_since ?? null,
            reinforced_until: $data->reinforced_until ?? null,
            state: $data->state ?? null,
            unanchor_at: $data->unanchor_at ?? null,
        );
    }
}