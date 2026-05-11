<?php

namespace Seatplus\EsiClient\Generated\Responses\Corporation;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationsCorporationIdStructuresItem
{
    public function __construct(
        public readonly int $corporation_id,
        public readonly int $profile_id,
        public readonly string $state,
        public readonly int $structure_id,
        public readonly int $system_id,
        public readonly int $type_id,
        public readonly ?string $fuel_expires = null,
        public readonly ?string $name = null,
        public readonly ?string $next_reinforce_apply = null,
        public readonly ?int $next_reinforce_hour = null,
        public readonly ?int $reinforce_hour = null,
        public readonly ?array $services = null,
        public readonly ?string $state_timer_end = null,
        public readonly ?string $state_timer_start = null,
        public readonly ?string $unanchors_at = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            structure_id: $data->structure_id,
            type_id: $data->type_id,
            corporation_id: $data->corporation_id,
            system_id: $data->system_id,
            profile_id: $data->profile_id,
            state: $data->state,
            fuel_expires: $data->fuel_expires ?? null,
            name: $data->name ?? null,
            next_reinforce_apply: $data->next_reinforce_apply ?? null,
            next_reinforce_hour: $data->next_reinforce_hour ?? null,
            reinforce_hour: $data->reinforce_hour ?? null,
            services: isset($data->services) ? array_map(fn(object $i) => GetCorporationsCorporationIdStructuresItemServicesItem::from($i), (array) $data->services) : null,
            state_timer_end: $data->state_timer_end ?? null,
            state_timer_start: $data->state_timer_start ?? null,
            unanchors_at: $data->unanchors_at ?? null,
        );
    }
}