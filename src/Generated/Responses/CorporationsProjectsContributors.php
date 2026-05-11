<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsContributorsContributor;
use Seatplus\EsiClient\Generated\Responses\Cursor;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsContributors
{
    public function __construct(
        public readonly array $contributors,
        public readonly ?Cursor $cursor = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            contributors: array_map(fn(object $i) => CorporationsProjectsContributorsContributor::from($i), (array) ($data->contributors ?? [])),
            cursor: isset($data->cursor) ? Cursor::from($data->cursor) : null,
        );
    }
}