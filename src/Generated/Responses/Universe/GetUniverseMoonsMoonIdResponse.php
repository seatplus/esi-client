<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseMoonsMoonIdResponse
{
    public function __construct(
        public readonly int $moon_id,
        public readonly string $name,
        public readonly GetUniverseMoonsMoonIdResponsePosition $position,
        public readonly int $system_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            moon_id: $data->moon_id,
            name: $data->name,
            position: GetUniverseMoonsMoonIdResponsePosition::from($data->position),
            system_id: $data->system_id,
        );
    }
}