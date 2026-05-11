<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersFreelanceJobsParticipation
{
    public function __construct(
        public readonly int $contributed,
        public readonly string $last_modified,
        public readonly string $state,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            contributed: (int) ($data->contributed ?? 0),
            last_modified: (string) ($data->last_modified ?? ''),
            state: (string) ($data->state ?? ''),
        );
    }
}