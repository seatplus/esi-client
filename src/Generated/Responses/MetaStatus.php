<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\MetaStatusRoutestatus;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class MetaStatus
{
    public function __construct(
        public readonly array $routes,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            routes: array_map(fn(object $i) => MetaStatusRoutestatus::from($i), (array) ($data->routes ?? [])),
        );
    }
}