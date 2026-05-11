<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationmatchercorporation
{
    public function __construct(
        public readonly ?int $corporation_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            corporation_id: $data->corporation_id ?? null,
        );
    }
}