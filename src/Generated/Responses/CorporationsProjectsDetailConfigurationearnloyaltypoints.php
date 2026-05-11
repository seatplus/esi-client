<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationearnloyaltypoints
{
    public function __construct(
        public readonly ?array $corporations = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            corporations: isset($data->corporations) ? (array) $data->corporations : null,
        );
    }
}