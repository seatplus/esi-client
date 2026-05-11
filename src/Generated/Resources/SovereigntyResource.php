<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\SovereigntyCampaignsGetItem;
use Seatplus\EsiSchema\Responses\SovereigntyMapGetItem;
use Seatplus\EsiSchema\Responses\SovereigntyStructuresGetItem;

/**
 * ESI tag: Sovereignty
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class SovereigntyResource extends AbstractResource
{
    /**
     * @return EsiResult<array<SovereigntyCampaignsGetItem>>
     */
    public function getSovereigntyCampaigns(): EsiResult
    {
        $response = $this->client->invoke('get', '/sovereignty/campaigns', [], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => SovereigntyCampaignsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<SovereigntyMapGetItem>>
     */
    public function getSovereigntyMap(): EsiResult
    {
        $response = $this->client->invoke('get', '/sovereignty/map', [], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => SovereigntyMapGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<SovereigntyStructuresGetItem>>
     */
    public function getSovereigntyStructures(): EsiResult
    {
        $response = $this->client->invoke('get', '/sovereignty/structures', [], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => SovereigntyStructuresGetItem::from($item),
            (array) $response->data,
        ));
    }
}
