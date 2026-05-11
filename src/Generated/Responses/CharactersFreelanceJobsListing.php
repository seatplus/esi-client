<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailFreelancejob;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersFreelanceJobsListing
{
    public function __construct(
        public readonly array $freelance_jobs,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            freelance_jobs: array_map(fn(object $i) => FreelanceJobsDetailFreelancejob::from($i), (array) ($data->freelance_jobs ?? [])),
        );
    }
}