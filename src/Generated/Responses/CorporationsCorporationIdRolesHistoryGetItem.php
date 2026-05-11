<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdRolesHistoryGetItem
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
            changed_at: (string) ($data->changed_at ?? ''),
            character_id: (int) ($data->character_id ?? 0),
            issuer_id: (int) ($data->issuer_id ?? 0),
            new_roles: (array) ($data->new_roles ?? []),
            old_roles: (array) ($data->old_roles ?? []),
            role_type: (string) ($data->role_type ?? ''),
        );
    }
}