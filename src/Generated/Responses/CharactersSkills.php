<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\CharactersSkillsSkill;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CharactersSkills
{
    public function __construct(
        public readonly array $skills,
        public readonly int $total_sp,
        public readonly ?int $unallocated_sp = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            skills: array_map(fn(object $i) => CharactersSkillsSkill::from($i), (array) ($data->skills ?? [])),
            total_sp: $data->total_sp,
            unallocated_sp: $data->unallocated_sp ?? null,
        );
    }
}