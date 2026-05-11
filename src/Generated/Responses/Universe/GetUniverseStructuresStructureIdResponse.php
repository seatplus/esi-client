<?php

namespace Seatplus\EsiClient\Generated\Responses\Universe;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetUniverseStructuresStructureIdResponse
{
    public function __construct(
        public readonly string $name,
        public readonly int $owner_id,
        public readonly int $solar_system_id,
        public readonly ?GetUniverseStructuresStructureIdResponsePosition $position = null,
        public readonly ?int $type_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            name: $data->name,
            solar_system_id: $data->solar_system_id,
            owner_id: $data->owner_id,
            position: isset($data->position) ? GetUniverseStructuresStructureIdResponsePosition::from($data->position) : null,
            type_id: $data->type_id ?? null,
        );
    }
}