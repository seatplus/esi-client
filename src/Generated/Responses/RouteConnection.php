<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class RouteConnection
{
    public function __construct(
        public readonly int $from,
        public readonly int $to,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            from: $data->from,
            to: $data->to,
        );
    }
}