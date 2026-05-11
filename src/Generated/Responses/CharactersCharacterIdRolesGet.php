<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdRolesGet
{
    public function __construct(
        public readonly ?array $roles = null,
        public readonly ?array $roles_at_base = null,
        public readonly ?array $roles_at_hq = null,
        public readonly ?array $roles_at_other = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            roles: isset($data->roles) ? (array) $data->roles : null,
            roles_at_base: isset($data->roles_at_base) ? (array) $data->roles_at_base : null,
            roles_at_hq: isset($data->roles_at_hq) ? (array) $data->roles_at_hq : null,
            roles_at_other: isset($data->roles_at_other) ? (array) $data->roles_at_other : null,
        );
    }
}