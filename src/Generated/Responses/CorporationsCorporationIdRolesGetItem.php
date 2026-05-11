<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdRolesGetItem
{
    public function __construct(
        public readonly int $character_id,
        public readonly ?array $grantable_roles = null,
        public readonly ?array $grantable_roles_at_base = null,
        public readonly ?array $grantable_roles_at_hq = null,
        public readonly ?array $grantable_roles_at_other = null,
        public readonly ?array $roles = null,
        public readonly ?array $roles_at_base = null,
        public readonly ?array $roles_at_hq = null,
        public readonly ?array $roles_at_other = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character_id: $data->character_id,
            grantable_roles: isset($data->grantable_roles) ? (array) $data->grantable_roles : null,
            grantable_roles_at_base: isset($data->grantable_roles_at_base) ? (array) $data->grantable_roles_at_base : null,
            grantable_roles_at_hq: isset($data->grantable_roles_at_hq) ? (array) $data->grantable_roles_at_hq : null,
            grantable_roles_at_other: isset($data->grantable_roles_at_other) ? (array) $data->grantable_roles_at_other : null,
            roles: isset($data->roles) ? (array) $data->roles : null,
            roles_at_base: isset($data->roles_at_base) ? (array) $data->roles_at_base : null,
            roles_at_hq: isset($data->roles_at_hq) ? (array) $data->roles_at_hq : null,
            roles_at_other: isset($data->roles_at_other) ? (array) $data->roles_at_other : null,
        );
    }
}