<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailProgress;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailReward;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailFreelancejob
{
    public function __construct(
        public readonly string $id,
        public readonly string $last_modified,
        public readonly string $name,
        public readonly FreelanceJobsDetailProgress $progress,
        public readonly string $state,
        public readonly ?FreelanceJobsDetailReward $reward = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            id: $data->id,
            last_modified: $data->last_modified,
            name: $data->name,
            progress: FreelanceJobsDetailProgress::from($data->progress),
            state: $data->state,
            reward: isset($data->reward) ? FreelanceJobsDetailReward::from($data->reward) : null,
        );
    }
}