<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersCharacterIdLoyaltyPointsGetItem
{
    public function __construct(
        public readonly int $corporation_id,
        public readonly int $loyalty_points,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            corporation_id: $data->corporation_id,
            loyalty_points: $data->loyalty_points,
        );
    }
}