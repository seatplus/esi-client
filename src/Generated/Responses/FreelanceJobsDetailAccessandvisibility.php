<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailRestrictions;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailAccessandvisibility
{
    public function __construct(
        public readonly bool $acl_protected,
        public readonly ?array $broadcast_locations = null,
        public readonly ?FreelanceJobsDetailRestrictions $restrictions = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            acl_protected: (bool) ($data->acl_protected ?? false),
            broadcast_locations: isset($data->broadcast_locations) ? (array) $data->broadcast_locations : null,
            restrictions: isset($data->restrictions) ? FreelanceJobsDetailRestrictions::from($data->restrictions) : null,
        );
    }
}