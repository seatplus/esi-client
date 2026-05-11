<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdOrdersGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdOrdersHistoryGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdOrdersGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdOrdersHistoryGetItem;
use Seatplus\EsiClient\Generated\Responses\MarketsGroupsMarketGroupIdGet;
use Seatplus\EsiClient\Generated\Responses\MarketsPricesGetItem;
use Seatplus\EsiClient\Generated\Responses\MarketsStructuresStructureIdGetItem;
use Seatplus\EsiClient\Generated\Responses\MarketsRegionIdHistoryGetItem;
use Seatplus\EsiClient\Generated\Responses\MarketsRegionIdOrdersGetItem;

/**
 * ESI tag: Market
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class MarketResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdOrdersGetItem>>
     * @scope esi-markets.read_character_orders.v1
     */
    public function getCharactersCharacterIdOrders(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/orders', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdOrdersGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdOrdersHistoryGetItem>>
     * @scope esi-markets.read_character_orders.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCharactersCharacterIdOrdersHistory(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/orders/history', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdOrdersHistoryGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdOrdersGetItem>>
     * @scope esi-markets.read_corporation_orders.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdOrders(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/orders', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdOrdersGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdOrdersHistoryGetItem>>
     * @scope esi-markets.read_corporation_orders.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdOrdersHistory(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/orders/history', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdOrdersHistoryGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getMarketsGroups(): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/groups', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<MarketsGroupsMarketGroupIdGet>
     */
    public function getMarketsGroupsMarketGroupId(int $marketGroupId): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/groups/{market_group_id}', ['market_group_id' => $marketGroupId], 'latest', []);
        return EsiResult::fromResponse($response, MarketsGroupsMarketGroupIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<MarketsPricesGetItem>>
     */
    public function getMarketsPrices(): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/prices', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => MarketsPricesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<MarketsStructuresStructureIdGetItem>>
     * @scope esi-markets.structure_markets.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getMarketsStructuresStructureId(int $structureId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/structures/{structure_id}', ['structure_id' => $structureId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => MarketsStructuresStructureIdGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<MarketsRegionIdHistoryGetItem>>
     */
    public function getMarketsRegionIdHistory(int $regionId, int $typeId): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/{region_id}/history', ['region_id' => $regionId], 'latest', ['type_id' => $typeId]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => MarketsRegionIdHistoryGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<MarketsRegionIdOrdersGetItem>>
     * @paginated Use $page param to iterate pages.
     */
    public function getMarketsRegionIdOrders(string $orderType, int $regionId, int $page = 1, ?int $typeId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/{region_id}/orders', ['region_id' => $regionId], 'latest', ['order_type' => $orderType, 'page' => $page, 'type_id' => $typeId]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => MarketsRegionIdOrdersGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     * @paginated Use $page param to iterate pages.
     */
    public function getMarketsRegionIdTypes(int $regionId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/markets/{region_id}/types', ['region_id' => $regionId], 'latest', ['page' => $page]);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }
}