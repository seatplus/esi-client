<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseAncestriesItem;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseAsteroidBeltsAsteroidBeltIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseBloodlinesItem;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseCategoriesCategoryIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseConstellationsConstellationIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseFactionsItem;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseGraphicsGraphicIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseGroupsGroupIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseMoonsMoonIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniversePlanetsPlanetIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseRacesItem;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseRegionsRegionIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseStargatesStargateIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseStarsStarIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseStationsStationIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseStructuresStructureIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseSystemJumpsItem;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseSystemKillsItem;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseSystemsSystemIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\GetUniverseTypesTypeIdResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\PostUniverseIdsResponse;
use Seatplus\EsiClient\Generated\Responses\Universe\PostUniverseNamesItem;

/**
 * ESI tag: Universe
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class UniverseResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetUniverseAncestriesItem>>
     */
    public function getUniverseAncestries(?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/ancestries/', [], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetUniverseAncestriesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetUniverseAsteroidBeltsAsteroidBeltIdResponse>
     */
    public function getUniverseAsteroidBeltsAsteroidBeltId(int $asteroidBeltId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/asteroid_belts/{asteroid_belt_id}/', ['asteroid_belt_id' => $asteroidBeltId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniverseAsteroidBeltsAsteroidBeltIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetUniverseBloodlinesItem>>
     */
    public function getUniverseBloodlines(?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/bloodlines/', [], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetUniverseBloodlinesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseCategories(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/categories/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetUniverseCategoriesCategoryIdResponse>
     */
    public function getUniverseCategoriesCategoryId(int $categoryId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/categories/{category_id}/', ['category_id' => $categoryId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, GetUniverseCategoriesCategoryIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseConstellations(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/constellations/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetUniverseConstellationsConstellationIdResponse>
     */
    public function getUniverseConstellationsConstellationId(int $constellationId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/constellations/{constellation_id}/', ['constellation_id' => $constellationId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, GetUniverseConstellationsConstellationIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetUniverseFactionsItem>>
     */
    public function getUniverseFactions(?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/factions/', [], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetUniverseFactionsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseGraphics(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/graphics/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetUniverseGraphicsGraphicIdResponse>
     */
    public function getUniverseGraphicsGraphicId(int $graphicId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/graphics/{graphic_id}/', ['graphic_id' => $graphicId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniverseGraphicsGraphicIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getUniverseGroups(int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/groups/', [], 'latest', ['page' => $page]);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetUniverseGroupsGroupIdResponse>
     */
    public function getUniverseGroupsGroupId(int $groupId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/groups/{group_id}/', ['group_id' => $groupId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, GetUniverseGroupsGroupIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<PostUniverseIdsResponse>
     */
    public function postUniverseIds(mixed $names, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('post', '/universe/ids/', [], 'latest', ['language' => $language], (array) $names);
        return EsiResult::fromResponse($response, PostUniverseIdsResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetUniverseMoonsMoonIdResponse>
     */
    public function getUniverseMoonsMoonId(int $moonId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/moons/{moon_id}/', ['moon_id' => $moonId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniverseMoonsMoonIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<PostUniverseNamesItem>>
     */
    public function postUniverseNames(mixed $ids): EsiResult
    {
        $response = $this->client->invoke('post', '/universe/names/', [], 'latest', [], (array) $ids);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => PostUniverseNamesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetUniversePlanetsPlanetIdResponse>
     */
    public function getUniversePlanetsPlanetId(int $planetId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/planets/{planet_id}/', ['planet_id' => $planetId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniversePlanetsPlanetIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetUniverseRacesItem>>
     */
    public function getUniverseRaces(?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/races/', [], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetUniverseRacesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseRegions(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/regions/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetUniverseRegionsRegionIdResponse>
     */
    public function getUniverseRegionsRegionId(int $regionId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/regions/{region_id}/', ['region_id' => $regionId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, GetUniverseRegionsRegionIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetUniverseStargatesStargateIdResponse>
     */
    public function getUniverseStargatesStargateId(int $stargateId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/stargates/{stargate_id}/', ['stargate_id' => $stargateId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniverseStargatesStargateIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetUniverseStarsStarIdResponse>
     */
    public function getUniverseStarsStarId(int $starId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/stars/{star_id}/', ['star_id' => $starId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniverseStarsStarIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetUniverseStationsStationIdResponse>
     */
    public function getUniverseStationsStationId(int $stationId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/stations/{station_id}/', ['station_id' => $stationId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniverseStationsStationIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseStructures(?string $filter = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/structures/', [], 'latest', ['filter' => $filter]);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetUniverseStructuresStructureIdResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getUniverseStructuresStructureId(int $structureId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/structures/{structure_id}/', ['structure_id' => $structureId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniverseStructuresStructureIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetUniverseSystemJumpsItem>>
     */
    public function getUniverseSystemJumps(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/system_jumps/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetUniverseSystemJumpsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetUniverseSystemKillsItem>>
     */
    public function getUniverseSystemKills(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/system_kills/', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetUniverseSystemKillsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseSystems(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/systems/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetUniverseSystemsSystemIdResponse>
     */
    public function getUniverseSystemsSystemId(int $systemId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/systems/{system_id}/', ['system_id' => $systemId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, GetUniverseSystemsSystemIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getUniverseTypes(int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/types/', [], 'latest', ['page' => $page]);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetUniverseTypesTypeIdResponse>
     */
    public function getUniverseTypesTypeId(int $typeId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/types/{type_id}/', ['type_id' => $typeId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, GetUniverseTypesTypeIdResponse::from($response->data));
    }
}