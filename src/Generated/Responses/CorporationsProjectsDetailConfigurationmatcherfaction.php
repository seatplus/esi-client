<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationmatcherfaction
{
    public function __construct(
        public readonly ?int $faction_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            faction_id: $data->faction_id ?? null,
        );
    }
}