<?php

namespace Seatplus\EsiClient\Generated\Responses\Fleets;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetFleetsFleetIdResponse
{
    public function __construct(
        public readonly bool $is_free_move,
        public readonly bool $is_registered,
        public readonly bool $is_voice_enabled,
        public readonly string $motd,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            motd: $data->motd,
            is_free_move: $data->is_free_move,
            is_registered: $data->is_registered,
            is_voice_enabled: $data->is_voice_enabled,
        );
    }
}