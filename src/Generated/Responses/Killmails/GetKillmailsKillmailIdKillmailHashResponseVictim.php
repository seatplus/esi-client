<?php

namespace Seatplus\EsiClient\Generated\Responses\Killmails;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetKillmailsKillmailIdKillmailHashResponseVictim
{
    public function __construct(
        public readonly int $damage_taken,
        public readonly int $ship_type_id,
        public readonly ?int $alliance_id = null,
        public readonly ?int $character_id = null,
        public readonly ?int $corporation_id = null,
        public readonly ?int $faction_id = null,
        public readonly ?array $items = null,
        public readonly ?GetKillmailsKillmailIdKillmailHashResponseVictimPosition $position = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            damage_taken: $data->damage_taken,
            ship_type_id: $data->ship_type_id,
            alliance_id: $data->alliance_id ?? null,
            character_id: $data->character_id ?? null,
            corporation_id: $data->corporation_id ?? null,
            faction_id: $data->faction_id ?? null,
            items: isset($data->items) ? array_map(fn(object $i) => GetKillmailsKillmailIdKillmailHashResponseVictimItemsItem::from($i), (array) $data->items) : null,
            position: isset($data->position) ? GetKillmailsKillmailIdKillmailHashResponseVictimPosition::from($data->position) : null,
        );
    }
}