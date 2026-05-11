<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\FactionWarfare\GetCharactersCharacterIdFwStatsResponse;
use Seatplus\EsiClient\Generated\Responses\FactionWarfare\GetCorporationsCorporationIdFwStatsResponse;
use Seatplus\EsiClient\Generated\Responses\FactionWarfare\GetFwLeaderboardsCharactersResponse;
use Seatplus\EsiClient\Generated\Responses\FactionWarfare\GetFwLeaderboardsCorporationsResponse;
use Seatplus\EsiClient\Generated\Responses\FactionWarfare\GetFwLeaderboardsResponse;
use Seatplus\EsiClient\Generated\Responses\FactionWarfare\GetFwStatsItem;
use Seatplus\EsiClient\Generated\Responses\FactionWarfare\GetFwSystemsItem;
use Seatplus\EsiClient\Generated\Responses\FactionWarfare\GetFwWarsItem;

/**
 * ESI tag: Faction Warfare
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class FactionWarfareResource extends AbstractResource
{
    /**
     * @return EsiResult<GetCharactersCharacterIdFwStatsResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdFwStats(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fw/stats/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdFwStatsResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetCorporationsCorporationIdFwStatsResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdFwStats(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/fw/stats/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, GetCorporationsCorporationIdFwStatsResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetFwLeaderboardsResponse>
     */
    public function getFwLeaderboards(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/leaderboards/', [], 'latest', []);
        return EsiResult::fromResponse($response, GetFwLeaderboardsResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetFwLeaderboardsCharactersResponse>
     */
    public function getFwLeaderboardsCharacters(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/leaderboards/characters/', [], 'latest', []);
        return EsiResult::fromResponse($response, GetFwLeaderboardsCharactersResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetFwLeaderboardsCorporationsResponse>
     */
    public function getFwLeaderboardsCorporations(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/leaderboards/corporations/', [], 'latest', []);
        return EsiResult::fromResponse($response, GetFwLeaderboardsCorporationsResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetFwStatsItem>>
     */
    public function getFwStats(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/stats/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetFwStatsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetFwSystemsItem>>
     */
    public function getFwSystems(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/systems/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetFwSystemsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetFwWarsItem>>
     */
    public function getFwWars(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/wars/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetFwWarsItem::from($item),
            (array) $response->data,
        ));
    }
}