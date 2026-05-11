<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetCharactersCharacterIdContractsContractIdBidsItem;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetCharactersCharacterIdContractsContractIdItemsItem;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetCharactersCharacterIdContractsItem;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetContractsPublicBidsContractIdItem;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetContractsPublicItemsContractIdItem;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetContractsPublicRegionIdItem;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetCorporationsCorporationIdContractsContractIdBidsItem;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetCorporationsCorporationIdContractsContractIdItemsItem;
use Seatplus\EsiClient\Generated\Responses\Contracts\GetCorporationsCorporationIdContractsItem;

/**
 * ESI tag: Contracts
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class ContractsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdContractsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCharactersCharacterIdContracts(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contracts/', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdContractsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdContractsContractIdBidsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdContractsContractIdBids(int $characterId, int $contractId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contracts/{contract_id}/bids/', ['character_id' => $characterId, 'contract_id' => $contractId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdContractsContractIdBidsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdContractsContractIdItemsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdContractsContractIdItems(int $characterId, int $contractId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contracts/{contract_id}/items/', ['character_id' => $characterId, 'contract_id' => $contractId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdContractsContractIdItemsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetContractsPublicBidsContractIdItem>>
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getContractsPublicBidsContractId(int $contractId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/contracts/public/bids/{contract_id}/', ['contract_id' => $contractId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetContractsPublicBidsContractIdItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetContractsPublicItemsContractIdItem>>
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getContractsPublicItemsContractId(int $contractId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/contracts/public/items/{contract_id}/', ['contract_id' => $contractId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetContractsPublicItemsContractIdItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetContractsPublicRegionIdItem>>
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getContractsPublicRegionId(int $regionId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/contracts/public/{region_id}/', ['region_id' => $regionId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetContractsPublicRegionIdItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdContractsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdContracts(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contracts/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdContractsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdContractsContractIdBidsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdContractsContractIdBids(int $contractId, int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contracts/{contract_id}/bids/', ['contract_id' => $contractId, 'corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdContractsContractIdBidsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdContractsContractIdItemsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdContractsContractIdItems(int $contractId, int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contracts/{contract_id}/items/', ['contract_id' => $contractId, 'corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdContractsContractIdItemsItem::from($item),
            (array) $response->data,
        ));
    }
}