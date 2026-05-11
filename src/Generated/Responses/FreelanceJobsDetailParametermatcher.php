<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailParametermatchervalue;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailParametermatcher
{
    public function __construct(
        public readonly array $values,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            values: array_map(fn(object $i) => FreelanceJobsDetailParametermatchervalue::from($i), (array) ($data->values ?? [])),
        );
    }
}