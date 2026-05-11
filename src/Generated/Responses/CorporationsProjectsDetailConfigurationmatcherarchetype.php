<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationmatcherarchetype
{
    public function __construct(
        public readonly ?int $archetype_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            archetype_id: $data->archetype_id ?? null,
        );
    }
}