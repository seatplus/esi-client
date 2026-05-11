<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailContribution
{
    public function __construct(
        public readonly ?int $participation_limit = null,
        public readonly ?float $reward_per_contribution = null,
        public readonly ?int $submission_limit = null,
        public readonly ?float $submission_multiplier = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            participation_limit: $data->participation_limit ?? null,
            reward_per_contribution: $data->reward_per_contribution ?? null,
            submission_limit: $data->submission_limit ?? null,
            submission_multiplier: $data->submission_multiplier ?? null,
        );
    }
}