<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Industry\GetCharactersCharacterIdIndustryJobsItem;
use Seatplus\EsiClient\Generated\Responses\Industry\GetCharactersCharacterIdMiningItem;
use Seatplus\EsiClient\Generated\Responses\Industry\GetCorporationCorporationIdMiningExtractionsItem;
use Seatplus\EsiClient\Generated\Responses\Industry\GetCorporationCorporationIdMiningObserversItem;
use Seatplus\EsiClient\Generated\Responses\Industry\GetCorporationCorporationIdMiningObserversObserverIdItem;
use Seatplus\EsiClient\Generated\Responses\Industry\GetCorporationsCorporationIdIndustryJobsItem;
use Seatplus\EsiClient\Generated\Responses\Industry\GetIndustryFacilitiesItem;
use Seatplus\EsiClient\Generated\Responses\Industry\GetIndustrySystemsItem;

/**
 * ESI tag: Industry
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class IndustryResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdIndustryJobsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdIndustryJobs(int $characterId, ?bool $includeCompleted = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/industry/jobs/', ['character_id' => $characterId], 'latest', ['include_completed' => $includeCompleted]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdIndustryJobsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdMiningItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCharactersCharacterIdMining(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mining/', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdMiningItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationCorporationIdMiningExtractionsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationCorporationIdMiningExtractions(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporation/{corporation_id}/mining/extractions/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationCorporationIdMiningExtractionsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationCorporationIdMiningObserversItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationCorporationIdMiningObservers(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporation/{corporation_id}/mining/observers/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationCorporationIdMiningObserversItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationCorporationIdMiningObserversObserverIdItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationCorporationIdMiningObserversObserverId(int $corporationId, int $observerId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporation/{corporation_id}/mining/observers/{observer_id}/', ['corporation_id' => $corporationId, 'observer_id' => $observerId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationCorporationIdMiningObserversObserverIdItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdIndustryJobsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdIndustryJobs(int $corporationId, ?bool $includeCompleted = null, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/industry/jobs/', ['corporation_id' => $corporationId], 'latest', ['include_completed' => $includeCompleted, 'page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdIndustryJobsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetIndustryFacilitiesItem>>
     */
    public function getIndustryFacilities(): EsiResult
    {
        $response = $this->client->invoke('get', '/industry/facilities/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetIndustryFacilitiesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetIndustrySystemsItem>>
     */
    public function getIndustrySystems(): EsiResult
    {
        $response = $this->client->invoke('get', '/industry/systems/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetIndustrySystemsItem::from($item),
            (array) $response->data,
        ));
    }
}