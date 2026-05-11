<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdStarbasesStarbaseIdResponse
{
    public function __construct(
        public readonly bool $allow_alliance_members,
        public readonly bool $allow_corporation_members,
        public readonly string $anchor,
        public readonly bool $attack_if_at_war,
        public readonly bool $attack_if_other_security_status_dropping,
        public readonly string $fuel_bay_take,
        public readonly string $fuel_bay_view,
        public readonly string $offline,
        public readonly string $online,
        public readonly string $unanchor,
        public readonly bool $use_alliance_standings,
        public readonly ?float $attack_security_status_threshold = null,
        public readonly ?float $attack_standing_threshold = null,
        public readonly ?array $fuels = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            fuel_bay_view: $data->fuel_bay_view,
            fuel_bay_take: $data->fuel_bay_take,
            anchor: $data->anchor,
            unanchor: $data->unanchor,
            online: $data->online,
            offline: $data->offline,
            allow_corporation_members: $data->allow_corporation_members,
            allow_alliance_members: $data->allow_alliance_members,
            use_alliance_standings: $data->use_alliance_standings,
            attack_if_other_security_status_dropping: $data->attack_if_other_security_status_dropping,
            attack_if_at_war: $data->attack_if_at_war,
            attack_security_status_threshold: $data->attack_security_status_threshold ?? null,
            attack_standing_threshold: $data->attack_standing_threshold ?? null,
            fuels: isset($data->fuels) ? array_map(fn(object $i) => GetCorporationsCorporationIdStarbasesStarbaseIdResponseFuelsItem::from($i), (array) $data->fuels) : null,
        );
    }
}