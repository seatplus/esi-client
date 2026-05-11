<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdContractsContractIdBidsGetItem;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdContractsContractIdItemsGetItem;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdContractsGetItem;
use Seatplus\EsiSchema\Responses\ContractsPublicBidsContractIdGetItem;
use Seatplus\EsiSchema\Responses\ContractsPublicItemsContractIdGetItem;
use Seatplus\EsiSchema\Responses\ContractsPublicRegionIdGetItem;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdContractsContractIdBidsGetItem;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdContractsContractIdItemsGetItem;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdContractsGetItem;

/**
 * ESI tag: Contracts
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class ContractsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdContractsGetItem>>
     *
     * @scope esi-contracts.read_character_contracts.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getCharactersCharacterIdContracts(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contracts', ['character_id' => $characterId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdContractsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdContractsContractIdBidsGetItem>>
     *
     * @scope esi-contracts.read_character_contracts.v1
     */
    public function getCharactersCharacterIdContractsContractIdBids(int $characterId, int $contractId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contracts/{contract_id}/bids', ['character_id' => $characterId, 'contract_id' => $contractId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdContractsContractIdBidsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdContractsContractIdItemsGetItem>>
     *
     * @scope esi-contracts.read_character_contracts.v1
     */
    public function getCharactersCharacterIdContractsContractIdItems(int $characterId, int $contractId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contracts/{contract_id}/items', ['character_id' => $characterId, 'contract_id' => $contractId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdContractsContractIdItemsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<ContractsPublicBidsContractIdGetItem>>
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getContractsPublicBidsContractId(int $contractId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/contracts/public/bids/{contract_id}', ['contract_id' => $contractId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => ContractsPublicBidsContractIdGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<ContractsPublicItemsContractIdGetItem>>
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getContractsPublicItemsContractId(int $contractId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/contracts/public/items/{contract_id}', ['contract_id' => $contractId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => ContractsPublicItemsContractIdGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<ContractsPublicRegionIdGetItem>>
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getContractsPublicRegionId(int $regionId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/contracts/public/{region_id}', ['region_id' => $regionId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => ContractsPublicRegionIdGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdContractsGetItem>>
     *
     * @scope esi-contracts.read_corporation_contracts.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdContracts(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contracts', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdContractsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdContractsContractIdBidsGetItem>>
     *
     * @scope esi-contracts.read_corporation_contracts.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdContractsContractIdBids(int $contractId, int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contracts/{contract_id}/bids', ['contract_id' => $contractId, 'corporation_id' => $corporationId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdContractsContractIdBidsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdContractsContractIdItemsGetItem>>
     *
     * @scope esi-contracts.read_corporation_contracts.v1
     */
    public function getCorporationsCorporationIdContractsContractIdItems(int $contractId, int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contracts/{contract_id}/items', ['contract_id' => $contractId, 'corporation_id' => $corporationId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdContractsContractIdItemsGetItem::from($item),
            (array) $response->data,
        ));
    }
}
