<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class Error
{
    public function __construct(
        public readonly string $error,
        public readonly ?array $details = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            error: (string) ($data->error ?? ''),
            details: isset($data->details) ? (array) $data->details : null,
        );
    }
}