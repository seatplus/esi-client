<?php

namespace Seatplus\EsiClient\Generated\Responses\Killmails;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdKillmailsRecentItem
{
    public function __construct(
        public readonly string $killmail_hash,
        public readonly int $killmail_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            killmail_id: $data->killmail_id,
            killmail_hash: $data->killmail_hash,
        );
    }
}