<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiSchema\Responses\MetaChangelog;
use Seatplus\EsiSchema\Responses\MetaCompatibilityDates;
use Seatplus\EsiSchema\Responses\MetaStatus;

/**
 * ESI tag: Meta
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class MetaResource extends AbstractResource
{
    public function getMetaChangelog(): MetaChangelog
    {
        $response = $this->client->invoke('get', '/meta/changelog', [], 'latest', []);
        $dto = MetaChangelog::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    public function getMetaCompatibilityDates(): MetaCompatibilityDates
    {
        $response = $this->client->invoke('get', '/meta/compatibility-dates', [], 'latest', []);
        $dto = MetaCompatibilityDates::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    public function getMetaStatus(): MetaStatus
    {
        $response = $this->client->invoke('get', '/meta/status', [], 'latest', []);
        $dto = MetaStatus::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }
}
