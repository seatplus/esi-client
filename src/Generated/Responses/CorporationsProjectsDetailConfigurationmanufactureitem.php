<?php

namespace Seatplus\EsiClient\Generated\Responses;

/**
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class CorporationsProjectsDetailConfigurationmanufactureitem
{
    public function __construct(
        public readonly string $owner,
        public readonly ?array $docking_locations = null,
        public readonly ?array $items = null,
    ) {}

    public static function from(object $data): self
    {
        return new self(
            owner: (string) ($data->owner ?? ''),
            docking_locations: isset($data->docking_locations) ? (array) $data->docking_locations : null,
            items: isset($data->items) ? (array) $data->items : null,
        );
    }
}