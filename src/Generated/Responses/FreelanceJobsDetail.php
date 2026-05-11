<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailAccessandvisibility;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailConfiguration;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailDetails;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailProgress;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailContribution;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailReward;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetail
{
    public function __construct(
        public readonly FreelanceJobsDetailAccessandvisibility $access_and_visibility,
        public readonly FreelanceJobsDetailConfiguration $configuration,
        public readonly FreelanceJobsDetailDetails $details,
        public readonly string $id,
        public readonly string $last_modified,
        public readonly string $name,
        public readonly FreelanceJobsDetailProgress $progress,
        public readonly string $state,
        public readonly ?FreelanceJobsDetailContribution $contribution = null,
        public readonly ?FreelanceJobsDetailReward $reward = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            access_and_visibility: FreelanceJobsDetailAccessandvisibility::from($data->access_and_visibility),
            configuration: FreelanceJobsDetailConfiguration::from($data->configuration),
            details: FreelanceJobsDetailDetails::from($data->details),
            id: $data->id,
            last_modified: $data->last_modified,
            name: $data->name,
            progress: FreelanceJobsDetailProgress::from($data->progress),
            state: $data->state,
            contribution: isset($data->contribution) ? FreelanceJobsDetailContribution::from($data->contribution) : null,
            reward: isset($data->reward) ? FreelanceJobsDetailReward::from($data->reward) : null,
        );
    }
}