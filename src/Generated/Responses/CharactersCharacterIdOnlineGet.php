<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdOnlineGet
{
    public function __construct(
        public readonly bool $online,
        public readonly ?string $last_login = null,
        public readonly ?string $last_logout = null,
        public readonly ?int $logins = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            online: (bool) ($data->online ?? false),
            last_login: $data->last_login ?? null,
            last_logout: $data->last_logout ?? null,
            logins: $data->logins ?? null,
        );
    }
}