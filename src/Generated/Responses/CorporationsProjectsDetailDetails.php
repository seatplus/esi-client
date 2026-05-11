<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailDetails
{
    public function __construct(
        public readonly string $career,
        public readonly string $created,
        public readonly string $description,
        public readonly ?string $expires = null,
        public readonly ?string $finished = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            career: (string) ($data->career ?? ''),
            created: (string) ($data->created ?? ''),
            description: (string) ($data->description ?? ''),
            expires: $data->expires ?? null,
            finished: $data->finished ?? null,
        );
    }
}