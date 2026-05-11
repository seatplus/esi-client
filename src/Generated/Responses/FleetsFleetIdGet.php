<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class FleetsFleetIdGet
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
            is_free_move: $data->is_free_move,
            is_registered: $data->is_registered,
            is_voice_enabled: $data->is_voice_enabled,
            motd: $data->motd,
        );
    }
}