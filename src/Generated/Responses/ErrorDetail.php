<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class ErrorDetail
{
    public function __construct(
        public readonly ?string $location = null,
        public readonly ?string $message = null,
        public readonly mixed $value = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            location: $data->location ?? null,
            message: $data->message ?? null,
            value: $data->value ?? null,
        );
    }
}