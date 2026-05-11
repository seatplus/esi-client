<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FleetsFleetIdWingsWingIdSquadsPost
{
    public function __construct(
        public readonly int $squad_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            squad_id: (int) ($data->squad_id ?? 0),
        );
    }
}