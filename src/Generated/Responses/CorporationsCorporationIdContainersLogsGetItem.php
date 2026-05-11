<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdContainersLogsGetItem
{
    public function __construct(
        public readonly string $action,
        public readonly int $character_id,
        public readonly int $container_id,
        public readonly int $container_type_id,
        public readonly string $location_flag,
        public readonly int $location_id,
        public readonly string $logged_at,
        public readonly ?int $new_config_bitmask = null,
        public readonly ?int $old_config_bitmask = null,
        public readonly ?string $password_type = null,
        public readonly ?int $quantity = null,
        public readonly ?int $type_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            action: $data->action,
            character_id: $data->character_id,
            container_id: $data->container_id,
            container_type_id: $data->container_type_id,
            location_flag: $data->location_flag,
            location_id: $data->location_id,
            logged_at: $data->logged_at,
            new_config_bitmask: $data->new_config_bitmask ?? null,
            old_config_bitmask: $data->old_config_bitmask ?? null,
            password_type: $data->password_type ?? null,
            quantity: $data->quantity ?? null,
            type_id: $data->type_id ?? null,
        );
    }
}