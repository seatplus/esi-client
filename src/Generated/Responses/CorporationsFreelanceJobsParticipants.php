<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\CorporationsFreelanceJobsParticipantsParticipant;
use Seatplus\EsiClient\Generated\Responses\Cursor;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsFreelanceJobsParticipants
{
    public function __construct(
        public readonly array $participants,
        public readonly ?Cursor $cursor = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            participants: array_map(fn(object $i) => CorporationsFreelanceJobsParticipantsParticipant::from($i), (array) ($data->participants ?? [])),
            cursor: isset($data->cursor) ? Cursor::from($data->cursor) : null,
        );
    }
}