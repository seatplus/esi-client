<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationdestroyship
{
    public function __construct(
        public readonly ?array $identities = null,
        public readonly ?array $locations = null,
        public readonly ?array $ships = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            identities: isset($data->identities) ? (array) $data->identities : null,
            locations: isset($data->locations) ? (array) $data->locations : null,
            ships: isset($data->ships) ? (array) $data->ships : null,
        );
    }
}