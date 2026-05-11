<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class WarsWarIdKillmailsGetItem
{
    public function __construct(
        public readonly string $killmail_hash,
        public readonly int $killmail_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            killmail_hash: (string) ($data->killmail_hash ?? ''),
            killmail_id: (int) ($data->killmail_id ?? 0),
        );
    }
}