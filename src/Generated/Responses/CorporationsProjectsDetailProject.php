<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetailProgress;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetailReward;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailProject
{
    public function __construct(
        public readonly string $id,
        public readonly string $last_modified,
        public readonly string $name,
        public readonly CorporationsProjectsDetailProgress $progress,
        public readonly string $state,
        public readonly ?CorporationsProjectsDetailReward $reward = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            id: $data->id,
            last_modified: $data->last_modified,
            name: $data->name,
            progress: CorporationsProjectsDetailProgress::from($data->progress),
            state: $data->state,
            reward: isset($data->reward) ? CorporationsProjectsDetailReward::from($data->reward) : null,
        );
    }
}