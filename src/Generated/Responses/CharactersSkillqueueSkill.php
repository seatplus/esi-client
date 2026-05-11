<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersSkillqueueSkill
{
    public function __construct(
        public readonly int $finished_level,
        public readonly int $queue_position,
        public readonly int $skill_id,
        public readonly ?string $finish_date = null,
        public readonly ?int $level_end_sp = null,
        public readonly ?int $level_start_sp = null,
        public readonly ?string $start_date = null,
        public readonly ?int $training_start_sp = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            finished_level: $data->finished_level,
            queue_position: $data->queue_position,
            skill_id: $data->skill_id,
            finish_date: $data->finish_date ?? null,
            level_end_sp: $data->level_end_sp ?? null,
            level_start_sp: $data->level_start_sp ?? null,
            start_date: $data->start_date ?? null,
            training_start_sp: $data->training_start_sp ?? null,
        );
    }
}