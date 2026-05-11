<?php

namespace Seatplus\EsiClient\Generated\Responses\Industry;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCorporationCorporationIdMiningObserversItem
{
    public function __construct(
        public readonly string $last_updated,
        public readonly int $observer_id,
        public readonly string $observer_type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            last_updated: $data->last_updated,
            observer_id: $data->observer_id,
            observer_type: $data->observer_type,
        );
    }
}