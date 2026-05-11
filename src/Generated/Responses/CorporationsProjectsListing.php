<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetailProject;
use Seatplus\EsiClient\Generated\Responses\Cursor;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsListing
{
    public function __construct(
        public readonly array $projects,
        public readonly ?Cursor $cursor = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            projects: array_map(fn(object $i) => CorporationsProjectsDetailProject::from($i), (array) ($data->projects ?? [])),
            cursor: isset($data->cursor) ? Cursor::from($data->cursor) : null,
        );
    }
}