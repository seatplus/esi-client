<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetailCreator;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetailDetails;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetailProgress;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetailContribution;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetailReward;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetail
{
    public function __construct(
        public readonly mixed $configuration,
        public readonly CorporationsProjectsDetailCreator $creator,
        public readonly CorporationsProjectsDetailDetails $details,
        public readonly string $id,
        public readonly string $last_modified,
        public readonly string $name,
        public readonly CorporationsProjectsDetailProgress $progress,
        public readonly string $state,
        public readonly ?CorporationsProjectsDetailContribution $contribution = null,
        public readonly ?CorporationsProjectsDetailReward $reward = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            configuration: ($data->configuration ?? null),
            creator: CorporationsProjectsDetailCreator::from($data->creator ?? new \stdClass()),
            details: CorporationsProjectsDetailDetails::from($data->details ?? new \stdClass()),
            id: (string) ($data->id ?? ''),
            last_modified: (string) ($data->last_modified ?? ''),
            name: (string) ($data->name ?? ''),
            progress: CorporationsProjectsDetailProgress::from($data->progress ?? new \stdClass()),
            state: (string) ($data->state ?? ''),
            contribution: isset($data->contribution) ? CorporationsProjectsDetailContribution::from($data->contribution) : null,
            reward: isset($data->reward) ? CorporationsProjectsDetailReward::from($data->reward) : null,
        );
    }
}