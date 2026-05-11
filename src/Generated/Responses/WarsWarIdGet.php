<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class WarsWarIdGet
{
    public function __construct(
        public readonly mixed $aggressor,
        public readonly string $declared,
        public readonly mixed $defender,
        public readonly int $id,
        public readonly bool $mutual,
        public readonly bool $open_for_allies,
        public readonly ?array $allies = null,
        public readonly ?string $finished = null,
        public readonly ?string $retracted = null,
        public readonly ?string $started = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            aggressor: ($data->aggressor ?? null),
            declared: (string) ($data->declared ?? ''),
            defender: ($data->defender ?? null),
            id: (int) ($data->id ?? 0),
            mutual: (bool) ($data->mutual ?? false),
            open_for_allies: (bool) ($data->open_for_allies ?? false),
            allies: isset($data->allies) ? (array) $data->allies : null,
            finished: $data->finished ?? null,
            retracted: $data->retracted ?? null,
            started: $data->started ?? null,
        );
    }
}