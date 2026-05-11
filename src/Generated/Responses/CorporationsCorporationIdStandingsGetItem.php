<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdStandingsGetItem
{
    public function __construct(
        public readonly int $from_id,
        public readonly string $from_type,
        public readonly float $standing,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            from_id: (int) ($data->from_id ?? 0),
            from_type: (string) ($data->from_type ?? ''),
            standing: (float) ($data->standing ?? 0.0),
        );
    }
}