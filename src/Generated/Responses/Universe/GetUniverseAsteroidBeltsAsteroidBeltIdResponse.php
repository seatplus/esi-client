<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseAsteroidBeltsAsteroidBeltIdResponse
{
    public function __construct(
        public readonly string $name,
        public readonly GetUniverseAsteroidBeltsAsteroidBeltIdResponsePosition $position,
        public readonly int $system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name,
            position: GetUniverseAsteroidBeltsAsteroidBeltIdResponsePosition::from($data->position),
            system_id: $data->system_id,
        );
    }
}