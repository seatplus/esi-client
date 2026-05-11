<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdFwStatsGet;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdFwStatsGet;
use Seatplus\EsiSchema\Responses\FwLeaderboardsCharactersGet;
use Seatplus\EsiSchema\Responses\FwLeaderboardsCorporationsGet;
use Seatplus\EsiSchema\Responses\FwLeaderboardsGet;
use Seatplus\EsiSchema\Responses\FwStatsGetItem;
use Seatplus\EsiSchema\Responses\FwSystemsGetItem;
use Seatplus\EsiSchema\Responses\FwWarsGetItem;

/**
 * ESI tag: FactionWarfare
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class FactionWarfareResource extends AbstractResource
{
    /**
     * @scope esi-characters.read_fw_stats.v1
     */
    public function getCharactersCharacterIdFwStats(int $characterId): CharactersCharacterIdFwStatsGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fw/stats', ['character_id' => $characterId], 'latest', []);
        $dto = CharactersCharacterIdFwStatsGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-corporations.read_fw_stats.v1
     */
    public function getCorporationsCorporationIdFwStats(int $corporationId): CorporationsCorporationIdFwStatsGet
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/fw/stats', ['corporation_id' => $corporationId], 'latest', []);
        $dto = CorporationsCorporationIdFwStatsGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    public function getFwLeaderboards(): FwLeaderboardsGet
    {
        $response = $this->client->invoke('get', '/fw/leaderboards', [], 'latest', []);
        $dto = FwLeaderboardsGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    public function getFwLeaderboardsCharacters(): FwLeaderboardsCharactersGet
    {
        $response = $this->client->invoke('get', '/fw/leaderboards/characters', [], 'latest', []);
        $dto = FwLeaderboardsCharactersGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    public function getFwLeaderboardsCorporations(): FwLeaderboardsCorporationsGet
    {
        $response = $this->client->invoke('get', '/fw/leaderboards/corporations', [], 'latest', []);
        $dto = FwLeaderboardsCorporationsGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @return EsiResult<array<FwStatsGetItem>>
     */
    public function getFwStats(): EsiResult
    {
        $response = $this->client->invoke('get', '/fw/stats', [], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => FwStatsGetItem::from($item),
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
            fn (object $item) => FwSystemsGetItem::from($item),
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
            fn (object $item) => FwWarsGetItem::from($item),
            (array) $response->data,
        ));
    }
}
