<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdIndustryJobsGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdMiningGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationCorporationIdMiningExtractionsGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationCorporationIdMiningObserversGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationCorporationIdMiningObserversObserverIdGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdIndustryJobsGetItem;
use Seatplus\EsiClient\Generated\Responses\IndustryFacilitiesGetItem;
use Seatplus\EsiClient\Generated\Responses\IndustrySystemsGetItem;

/**
 * ESI tag: Industry
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class IndustryResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdIndustryJobsGetItem>>
     * @scope esi-industry.read_character_jobs.v1
     */
    public function getCharactersCharacterIdIndustryJobs(int $characterId, ?bool $includeCompleted = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/industry/jobs', ['character_id' => $characterId], 'latest', ['include_completed' => $includeCompleted]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdIndustryJobsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdMiningGetItem>>
     * @scope esi-industry.read_character_mining.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCharactersCharacterIdMining(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mining', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdMiningGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationCorporationIdMiningExtractionsGetItem>>
     * @scope esi-industry.read_corporation_mining.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationCorporationIdMiningExtractions(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporation/{corporation_id}/mining/extractions', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationCorporationIdMiningExtractionsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationCorporationIdMiningObserversGetItem>>
     * @scope esi-industry.read_corporation_mining.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationCorporationIdMiningObservers(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporation/{corporation_id}/mining/observers', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationCorporationIdMiningObserversGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationCorporationIdMiningObserversObserverIdGetItem>>
     * @scope esi-industry.read_corporation_mining.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationCorporationIdMiningObserversObserverId(int $corporationId, int $observerId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporation/{corporation_id}/mining/observers/{observer_id}', ['corporation_id' => $corporationId, 'observer_id' => $observerId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationCorporationIdMiningObserversObserverIdGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdIndustryJobsGetItem>>
     * @scope esi-industry.read_corporation_jobs.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdIndustryJobs(int $corporationId, ?bool $includeCompleted = null, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/industry/jobs', ['corporation_id' => $corporationId], 'latest', ['include_completed' => $includeCompleted, 'page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdIndustryJobsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<IndustryFacilitiesGetItem>>
     */
    public function getIndustryFacilities(): EsiResult
    {
        $response = $this->client->invoke('get', '/industry/facilities', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => IndustryFacilitiesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<IndustrySystemsGetItem>>
     */
    public function getIndustrySystems(): EsiResult
    {
        $response = $this->client->invoke('get', '/industry/systems', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => IndustrySystemsGetItem::from($item),
            (array) $response->data,
        ));
    }
}