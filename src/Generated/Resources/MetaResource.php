<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\MetaChangelog;
use Seatplus\EsiClient\Generated\Responses\MetaCompatibilityDates;
use Seatplus\EsiClient\Generated\Responses\MetaStatus;

/**
 * ESI tag: Meta
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class MetaResource extends AbstractResource
{
    /**
     * @return EsiResult<MetaChangelog>
     */
    public function getMetaChangelog(): EsiResult
    {
        $response = $this->client->invoke('get', '/meta/changelog', [], 'latest', []);
        return EsiResult::fromResponse($response, MetaChangelog::from($response->data));
    }

    /**
     * @return EsiResult<MetaCompatibilityDates>
     */
    public function getMetaCompatibilityDates(): EsiResult
    {
        $response = $this->client->invoke('get', '/meta/compatibility-dates', [], 'latest', []);
        return EsiResult::fromResponse($response, MetaCompatibilityDates::from($response->data));
    }

    /**
     * @return EsiResult<MetaStatus>
     */
    public function getMetaStatus(): EsiResult
    {
        $response = $this->client->invoke('get', '/meta/status', [], 'latest', []);
        return EsiResult::fromResponse($response, MetaStatus::from($response->data));
    }
}