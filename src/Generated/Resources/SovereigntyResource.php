<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Sovereignty\GetSovereigntyCampaignsItem;
use Seatplus\EsiClient\Generated\Responses\Sovereignty\GetSovereigntyMapItem;
use Seatplus\EsiClient\Generated\Responses\Sovereignty\GetSovereigntyStructuresItem;

/**
 * ESI tag: Sovereignty
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class SovereigntyResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetSovereigntyCampaignsItem>>
     */
    public function getSovereigntyCampaigns(): EsiResult
    {
        $response = $this->client->invoke('get', '/sovereignty/campaigns/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetSovereigntyCampaignsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetSovereigntyMapItem>>
     */
    public function getSovereigntyMap(): EsiResult
    {
        $response = $this->client->invoke('get', '/sovereignty/map/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetSovereigntyMapItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetSovereigntyStructuresItem>>
     */
    public function getSovereigntyStructures(): EsiResult
    {
        $response = $this->client->invoke('get', '/sovereignty/structures/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetSovereigntyStructuresItem::from($item),
            (array) $response->data,
        ));
    }
}