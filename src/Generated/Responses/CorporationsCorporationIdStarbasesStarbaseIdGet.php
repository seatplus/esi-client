<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsCorporationIdStarbasesStarbaseIdGet
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
            allow_alliance_members: $data->allow_alliance_members,
            allow_corporation_members: $data->allow_corporation_members,
            anchor: $data->anchor,
            attack_if_at_war: $data->attack_if_at_war,
            attack_if_other_security_status_dropping: $data->attack_if_other_security_status_dropping,
            fuel_bay_take: $data->fuel_bay_take,
            fuel_bay_view: $data->fuel_bay_view,
            offline: $data->offline,
            online: $data->online,
            unanchor: $data->unanchor,
            use_alliance_standings: $data->use_alliance_standings,
            attack_security_status_threshold: $data->attack_security_status_threshold ?? null,
            attack_standing_threshold: $data->attack_standing_threshold ?? null,
            fuels: isset($data->fuels) ? (array) $data->fuels : null,
        );
    }
}