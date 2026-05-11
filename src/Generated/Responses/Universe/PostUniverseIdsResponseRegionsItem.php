<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class PostUniverseIdsResponseRegionsItem
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            id: $data->id ?? null,
            name: $data->name ?? null,
        );
    }
}