<?php

namespace Seatplus\EsiClient\Generated\Responses\Killmails;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetKillmailsKillmailIdKillmailHashResponse
{
    public function __construct(
        public readonly array $attackers,
        public readonly int $killmail_id,
        public readonly string $killmail_time,
        public readonly int $solar_system_id,
        public readonly GetKillmailsKillmailIdKillmailHashResponseVictim $victim,
        public readonly ?int $moon_id = null,
        public readonly ?int $war_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            killmail_id: $data->killmail_id,
            killmail_time: $data->killmail_time,
            victim: GetKillmailsKillmailIdKillmailHashResponseVictim::from($data->victim),
            attackers: array_map(fn(object $i) => GetKillmailsKillmailIdKillmailHashResponseAttackersItem::from($i), (array) $data->attackers),
            solar_system_id: $data->solar_system_id,
            moon_id: $data->moon_id ?? null,
            war_id: $data->war_id ?? null,
        );
    }
}