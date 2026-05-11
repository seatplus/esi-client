<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class StatusGet
{
    public function __construct(
        public readonly int $players,
        public readonly string $server_version,
        public readonly string $start_time,
        public readonly ?bool $vip = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            players: (int) ($data->players ?? 0),
            server_version: (string) ($data->server_version ?? ''),
            start_time: (string) ($data->start_time ?? ''),
            vip: $data->vip ?? null,
        );
    }
}