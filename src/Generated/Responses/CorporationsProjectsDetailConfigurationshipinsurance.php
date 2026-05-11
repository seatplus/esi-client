<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationshipinsurance
{
    public function __construct(
        public readonly string $conflict_type,
        public readonly bool $reimburse_implants,
        public readonly ?array $identities = null,
        public readonly ?array $locations = null,
        public readonly ?array $ships = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            conflict_type: $data->conflict_type,
            reimburse_implants: $data->reimburse_implants,
            identities: isset($data->identities) ? (array) $data->identities : null,
            locations: isset($data->locations) ? (array) $data->locations : null,
            ships: isset($data->ships) ? (array) $data->ships : null,
        );
    }
}