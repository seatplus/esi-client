<?php

namespace Seatplus\EsiClient\Generated\Responses\Wars;

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class GetWarsWarIdResponse
{
    public function __construct(
        public readonly GetWarsWarIdResponseAggressor $aggressor,
        public readonly string $declared,
        public readonly GetWarsWarIdResponseDefender $defender,
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
            id: $data->id,
            declared: $data->declared,
            mutual: $data->mutual,
            open_for_allies: $data->open_for_allies,
            aggressor: GetWarsWarIdResponseAggressor::from($data->aggressor),
            defender: GetWarsWarIdResponseDefender::from($data->defender),
            allies: isset($data->allies) ? array_map(fn(object $i) => GetWarsWarIdResponseAlliesItem::from($i), (array) $data->allies) : null,
            finished: $data->finished ?? null,
            retracted: $data->retracted ?? null,
            started: $data->started ?? null,
        );
    }
}