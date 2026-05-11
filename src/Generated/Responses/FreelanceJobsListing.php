<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailFreelancejob;
use Seatplus\EsiClient\Generated\Responses\Cursor;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsListing
{
    public function __construct(
        public readonly array $freelance_jobs,
        public readonly ?Cursor $cursor = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            freelance_jobs: array_map(fn(object $i) => FreelanceJobsDetailFreelancejob::from($i), (array) ($data->freelance_jobs ?? [])),
            cursor: isset($data->cursor) ? Cursor::from($data->cursor) : null,
        );
    }
}