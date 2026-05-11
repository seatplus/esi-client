<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailParametermatcher;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailParametercorporationitemdelivery
{
    public function __construct(
        public readonly FreelanceJobsDetailParametermatcher $corporation_office_location,
        public readonly FreelanceJobsDetailParametermatcher $item_type,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            corporation_office_location: FreelanceJobsDetailParametermatcher::from($data->corporation_office_location),
            item_type: FreelanceJobsDetailParametermatcher::from($data->item_type),
        );
    }
}