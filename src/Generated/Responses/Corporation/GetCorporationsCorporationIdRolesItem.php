<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdRolesItem
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
            grantable_roles: $data->grantable_roles ?? null,
            grantable_roles_at_base: $data->grantable_roles_at_base ?? null,
            grantable_roles_at_hq: $data->grantable_roles_at_hq ?? null,
            grantable_roles_at_other: $data->grantable_roles_at_other ?? null,
            roles: $data->roles ?? null,
            roles_at_base: $data->roles_at_base ?? null,
            roles_at_hq: $data->roles_at_hq ?? null,
            roles_at_other: $data->roles_at_other ?? null,
        );
    }
}