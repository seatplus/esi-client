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
            action: (string) ($data->action ?? ''),
            character_id: (int) ($data->character_id ?? 0),
            container_id: (int) ($data->container_id ?? 0),
            container_type_id: (int) ($data->container_type_id ?? 0),
            location_flag: (string) ($data->location_flag ?? ''),
            location_id: (int) ($data->location_id ?? 0),
            logged_at: (string) ($data->logged_at ?? ''),
            new_config_bitmask: $data->new_config_bitmask ?? null,
            old_config_bitmask: $data->old_config_bitmask ?? null,
            password_type: $data->password_type ?? null,
            quantity: $data->quantity ?? null,
            type_id: $data->type_id ?? null,
        );
    }
}