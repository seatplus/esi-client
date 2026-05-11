<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationsalvagewreck
{
    public function __construct(
        public readonly ?array $locations = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            locations: isset($data->locations) ? (array) $data->locations : null,
        );
    }
}