<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Alliance\GetAlliancesAllianceIdIconsResponse;
use Seatplus\EsiClient\Generated\Responses\Alliance\GetAlliancesAllianceIdResponse;

/**
 * ESI tag: Alliance
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class AllianceResource extends AbstractResource
{
    /**
     * @return EsiResult<array<int>>
     */
    public function getAlliances(): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetAlliancesAllianceIdResponse>
     */
    public function getAlliancesAllianceId(int $allianceId): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/', ['alliance_id' => $allianceId], 'latest', []);
        return EsiResult::fromResponse($response, GetAlliancesAllianceIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getAlliancesAllianceIdCorporations(int $allianceId): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/corporations/', ['alliance_id' => $allianceId], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetAlliancesAllianceIdIconsResponse>
     */
    public function getAlliancesAllianceIdIcons(int $allianceId): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/icons/', ['alliance_id' => $allianceId], 'latest', []);
        return EsiResult::fromResponse($response, GetAlliancesAllianceIdIconsResponse::from($response->data));
    }
}