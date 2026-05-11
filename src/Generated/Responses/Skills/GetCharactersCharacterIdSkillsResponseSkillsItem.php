<?php

namespace Seatplus\EsiClient\Generated\Responses\Skills;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetCharactersCharacterIdSkillsResponseSkillsItem
{
    public function __construct(
        public readonly int $active_skill_level,
        public readonly int $skill_id,
        public readonly int $skillpoints_in_skill,
        public readonly int $trained_skill_level,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            skill_id: $data->skill_id,
            skillpoints_in_skill: $data->skillpoints_in_skill,
            trained_skill_level: $data->trained_skill_level,
            active_skill_level: $data->active_skill_level,
        );
    }
}