<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Market\GetCharactersCharacterIdOrdersHistoryItem;
use Seatplus\EsiClient\Generated\Responses\Market\GetCharactersCharacterIdOrdersItem;
use Seatplus\EsiClient\Generated\Responses\Market\GetCorporationsCorporationIdOrdersHistoryItem;
use Seatplus\EsiClient\Generated\Responses\Market\GetCorporationsCorporationIdOrdersItem;
use Seatplus\EsiClient\Generated\Responses\Market\GetMarketsGroupsMarketGroupIdResponse;
use Seatplus\EsiClient\Generated\Responses\Market\GetMarketsPricesItem;
use Seatplus\EsiClient\Generated\Responses\Market\GetMarketsRegionIdHistoryItem;
use Seatplus\EsiClient\Generated\Responses\Market\GetMarketsRegionIdOrdersItem;
use Seatplus\EsiClient\Generated\Responses\Market\GetMarketsStructuresStructureIdItem;

/**
 * ESI tag: Market
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class MarketResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdOrdersItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdOrders(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/orders/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdOrdersItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdOrdersHistoryItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCharactersCharacterIdOrdersHistory(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/orders/history/', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdOrdersHistoryItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdOrdersItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdOrders(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/orders/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdOrdersItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdOrdersHistoryItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdOrdersHistory(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/orders/history/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdOrdersHistoryItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getMarketsGroups(): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/groups/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetMarketsGroupsMarketGroupIdResponse>
     */
    public function getMarketsGroupsMarketGroupId(int $marketGroupId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/groups/{market_group_id}/', ['market_group_id' => $marketGroupId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, GetMarketsGroupsMarketGroupIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetMarketsPricesItem>>
     */
    public function getMarketsPrices(): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/prices/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetMarketsPricesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetMarketsStructuresStructureIdItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getMarketsStructuresStructureId(int $structureId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/structures/{structure_id}/', ['structure_id' => $structureId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetMarketsStructuresStructureIdItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetMarketsRegionIdHistoryItem>>
     */
    public function getMarketsRegionIdHistory(int $regionId, int $typeId): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/{region_id}/history/', ['region_id' => $regionId], 'latest', ['type_id' => $typeId]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetMarketsRegionIdHistoryItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetMarketsRegionIdOrdersItem>>
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getMarketsRegionIdOrders(int $regionId, string $orderType, int $page = 1, ?int $typeId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/{region_id}/orders/', ['region_id' => $regionId], 'latest', ['order_type' => $orderType, 'page' => $page, 'type_id' => $typeId]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetMarketsRegionIdOrdersItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getMarketsRegionIdTypes(int $regionId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/{region_id}/types/', ['region_id' => $regionId], 'latest', ['page' => $page]);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }
}