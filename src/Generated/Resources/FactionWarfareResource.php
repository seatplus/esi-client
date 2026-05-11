<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdFwStatsGet;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdFwStatsGet;
use Seatplus\EsiClient\Generated\Responses\FwLeaderboardsGet;
use Seatplus\EsiClient\Generated\Responses\FwLeaderboardsCharactersGet;
use Seatplus\EsiClient\Generated\Responses\FwLeaderboardsCorporationsGet;
use Seatplus\EsiClient\Generated\Responses\FwStatsGetItem;
use Seatplus\EsiClient\Generated\Responses\FwSystemsGetItem;
use Seatplus\EsiClient\Generated\Responses\FwWarsGetItem;

/**
 * ESI tag: FactionWarfare
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class FactionWarfareResource extends AbstractResource
{
    /**
     * @return EsiResult<CharactersCharacterIdFwStatsGet>
     * @scope esi-characters.read_fw_stats.v1
     */
    public function getCharactersCharacterIdFwStats(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fw/stats', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdFwStatsGet::from($response->data));
    }

    /**
     * @return EsiResult<CorporationsCorporationIdFwStatsGet>
     * @scope esi-corporations.read_fw_stats.v1
     */
    public function getCorporationsCorporationIdFwStats(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/fw/stats', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, CorporationsCorporationIdFwStatsGet::from($response->data));
    }

    /**
     * @return EsiResult<FwLeaderboardsGet>
     */
    public function getFwLeaderboards(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/leaderboards', [], 'latest', []);
        return EsiResult::fromResponse($response, FwLeaderboardsGet::from($response->data));
    }

    /**
     * @return EsiResult<FwLeaderboardsCharactersGet>
     */
    public function getFwLeaderboardsCharacters(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/leaderboards/characters', [], 'latest', []);
        return EsiResult::fromResponse($response, FwLeaderboardsCharactersGet::from($response->data));
    }

    /**
     * @return EsiResult<FwLeaderboardsCorporationsGet>
     */
    public function getFwLeaderboardsCorporations(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/leaderboards/corporations', [], 'latest', []);
        return EsiResult::fromResponse($response, FwLeaderboardsCorporationsGet::from($response->data));
    }

    /**
     * @return EsiResult<array<FwStatsGetItem>>
     */
    public function getFwStats(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/stats', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => FwStatsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<FwSystemsGetItem>>
     */
    public function getFwSystems(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/systems', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => FwSystemsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<FwWarsGetItem>>
     */
    public function getFwWars(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/wars', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => FwWarsGetItem::from($item),
            (array) $response->data,
        ));
    }
}