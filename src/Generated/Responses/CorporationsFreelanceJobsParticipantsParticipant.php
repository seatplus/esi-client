<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsFreelanceJobsParticipantsParticipant
{
    public function __construct(
        public readonly int $contributed,
        public readonly int $id,
        public readonly string $name,
        public readonly string $state,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            contributed: $data->contributed,
            id: $data->id,
            name: $data->name,
            state: $data->state,
        );
    }
}