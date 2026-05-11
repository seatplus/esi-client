<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationdefendfwcomplex
{
    public function __construct(
        public readonly ?array $archetypes = null,
        public readonly ?array $factions = null,
        public readonly ?array $locations = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            archetypes: isset($data->archetypes) ? (array) $data->archetypes : null,
            factions: isset($data->factions) ? (array) $data->factions : null,
            locations: isset($data->locations) ? (array) $data->locations : null,
        );
    }
}