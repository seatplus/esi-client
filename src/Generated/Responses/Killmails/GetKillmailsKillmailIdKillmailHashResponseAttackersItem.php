<?php

namespace Seatplus\EsiClient\Generated\Responses\Killmails;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetKillmailsKillmailIdKillmailHashResponseAttackersItem
{
    public function __construct(
        public readonly int $damage_done,
        public readonly bool $final_blow,
        public readonly float $security_status,
        public readonly ?int $alliance_id = null,
        public readonly ?int $character_id = null,
        public readonly ?int $corporation_id = null,
        public readonly ?int $faction_id = null,
        public readonly ?int $ship_type_id = null,
        public readonly ?int $weapon_type_id = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            security_status: $data->security_status,
            final_blow: $data->final_blow,
            damage_done: $data->damage_done,
            alliance_id: $data->alliance_id ?? null,
            character_id: $data->character_id ?? null,
            corporation_id: $data->corporation_id ?? null,
            faction_id: $data->faction_id ?? null,
            ship_type_id: $data->ship_type_id ?? null,
            weapon_type_id: $data->weapon_type_id ?? null,
        );
    }
}