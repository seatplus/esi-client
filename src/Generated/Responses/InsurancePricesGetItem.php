<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class InsurancePricesGetItem
{
    public function __construct(
        public readonly array $levels,
        public readonly int $type_id,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            levels: (array) ($data->levels ?? []),
            type_id: $data->type_id,
        );
    }
}