<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class KillmailsKillmailIdKillmailHashGet
{
    public function __construct(
        public readonly array $attackers,
        public readonly int $killmail_id,
        public readonly string $killmail_time,
        public readonly int $solar_system_id,
        public readonly mixed $victim,
        public readonly ?int $moon_id = null,
        public readonly ?int $war_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            attackers: (array) ($data->attackers ?? []),
            killmail_id: (int) ($data->killmail_id ?? 0),
            killmail_time: (string) ($data->killmail_time ?? ''),
            solar_system_id: (int) ($data->solar_system_id ?? 0),
            victim: ($data->victim ?? null),
            moon_id: $data->moon_id ?? null,
            war_id: $data->war_id ?? null,
        );
    }
}