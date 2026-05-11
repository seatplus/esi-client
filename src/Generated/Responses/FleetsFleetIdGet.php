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
            is_free_move: (bool) ($data->is_free_move ?? false),
            is_registered: (bool) ($data->is_registered ?? false),
            is_voice_enabled: (bool) ($data->is_voice_enabled ?? false),
            motd: (string) ($data->motd ?? ''),
        );
    }
}