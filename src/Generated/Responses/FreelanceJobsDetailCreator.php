<?php

namespace Seatplus\EsiClient\Generated\Responses;

use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailCreatorcharacter;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetailCreatorcorporation;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FreelanceJobsDetailCreator
{
    public function __construct(
        public readonly FreelanceJobsDetailCreatorcharacter $character,
        public readonly FreelanceJobsDetailCreatorcorporation $corporation,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            character: FreelanceJobsDetailCreatorcharacter::from($data->character),
            corporation: FreelanceJobsDetailCreatorcorporation::from($data->corporation),
        );
    }
}