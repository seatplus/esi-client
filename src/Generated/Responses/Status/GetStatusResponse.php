<?php

namespace Seatplus\EsiClient\Generated\Responses\Status;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetStatusResponse
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
            start_time: $data->start_time,
            players: $data->players,
            server_version: $data->server_version,
            vip: $data->vip ?? null,
        );
    }
}