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
            allow_alliance_members: (bool) ($data->allow_alliance_members ?? false),
            allow_corporation_members: (bool) ($data->allow_corporation_members ?? false),
            anchor: (string) ($data->anchor ?? ''),
            attack_if_at_war: (bool) ($data->attack_if_at_war ?? false),
            attack_if_other_security_status_dropping: (bool) ($data->attack_if_other_security_status_dropping ?? false),
            fuel_bay_take: (string) ($data->fuel_bay_take ?? ''),
            fuel_bay_view: (string) ($data->fuel_bay_view ?? ''),
            offline: (string) ($data->offline ?? ''),
            online: (string) ($data->online ?? ''),
            unanchor: (string) ($data->unanchor ?? ''),
            use_alliance_standings: (bool) ($data->use_alliance_standings ?? false),
            attack_security_status_threshold: $data->attack_security_status_threshold ?? null,
            attack_standing_threshold: $data->attack_standing_threshold ?? null,
            fuels: isset($data->fuels) ? (array) $data->fuels : null,
        );
    }
}