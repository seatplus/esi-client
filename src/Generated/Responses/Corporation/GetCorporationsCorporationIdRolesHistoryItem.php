<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdRolesHistoryItem
{
    public function __construct(
        public readonly string $changed_at,
        public readonly int $character_id,
        public readonly int $issuer_id,
        public readonly array $new_roles,
        public readonly array $old_roles,
        public readonly string $role_type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character_id: $data->character_id,
            changed_at: $data->changed_at,
            issuer_id: $data->issuer_id,
            role_type: $data->role_type,
            old_roles: $data->old_roles,
            new_roles: $data->new_roles,
        );
    }
}