<?php

namespace Seatplus\EsiClient\Generated\Responses\Character;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdRolesResponse
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
            roles: $data->roles ?? null,
            roles_at_base: $data->roles_at_base ?? null,
            roles_at_hq: $data->roles_at_hq ?? null,
            roles_at_other: $data->roles_at_other ?? null,
        );
    }
}