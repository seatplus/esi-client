<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\AllianceDetail;
use Seatplus\EsiClient\Generated\Responses\AlliancesAllianceIdIconsGet;

/**
 * ESI tag: Alliance
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class AllianceResource extends AbstractResource
{
    /**
     * @return EsiResult<array<int>>
     */
    public function getAlliances(): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<AllianceDetail>
     */
    public function getAlliancesAllianceId(int $allianceId): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}', ['alliance_id' => $allianceId], 'latest', []);
        return EsiResult::fromResponse($response, AllianceDetail::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getAlliancesAllianceIdCorporations(int $allianceId): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/corporations', ['alliance_id' => $allianceId], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<AlliancesAllianceIdIconsGet>
     */
    public function getAlliancesAllianceIdIcons(int $allianceId): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/icons', ['alliance_id' => $allianceId], 'latest', []);
        return EsiResult::fromResponse($response, AlliancesAllianceIdIconsGet::from($response->data));
    }
}