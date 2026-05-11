<?php

namespace Seatplus\EsiClient\Generated\Responses\Killmails;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetKillmailsKillmailIdKillmailHashResponseVictimItemsItemItemsItem
{
    public function __construct(
        public readonly int $flag,
        public readonly int $item_type_id,
        public readonly int $singleton,
        public readonly ?int $quantity_destroyed = null,
        public readonly ?int $quantity_dropped = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            item_type_id: $data->item_type_id,
            singleton: $data->singleton,
            flag: $data->flag,
            quantity_destroyed: $data->quantity_destroyed ?? null,
            quantity_dropped: $data->quantity_dropped ?? null,
        );
    }
}