<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\UniverseAncestriesGetItem;
use Seatplus\EsiClient\Generated\Responses\UniverseAsteroidBeltsAsteroidBeltIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseBloodlinesGetItem;
use Seatplus\EsiClient\Generated\Responses\UniverseCategoriesCategoryIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseConstellationsConstellationIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseFactionsGetItem;
use Seatplus\EsiClient\Generated\Responses\UniverseGraphicsGraphicIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseGroupsGroupIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseIdsPost;
use Seatplus\EsiClient\Generated\Responses\UniverseMoonsMoonIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseNamesPostItem;
use Seatplus\EsiClient\Generated\Responses\UniversePlanetsPlanetIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseRacesGetItem;
use Seatplus\EsiClient\Generated\Responses\UniverseRegionsRegionIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseStargatesStargateIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseStarsStarIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseStationsStationIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseStructuresStructureIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseSystemJumpsGetItem;
use Seatplus\EsiClient\Generated\Responses\UniverseSystemKillsGetItem;
use Seatplus\EsiClient\Generated\Responses\UniverseSystemsSystemIdGet;
use Seatplus\EsiClient\Generated\Responses\UniverseTypesTypeIdGet;

/**
 * ESI tag: Universe
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class UniverseResource extends AbstractResource
{
    /**
     * @return EsiResult<array<UniverseAncestriesGetItem>>
     */
    public function getUniverseAncestries(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/ancestries', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => UniverseAncestriesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<UniverseAsteroidBeltsAsteroidBeltIdGet>
     */
    public function getUniverseAsteroidBeltsAsteroidBeltId(int $asteroidBeltId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/asteroid_belts/{asteroid_belt_id}', ['asteroid_belt_id' => $asteroidBeltId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseAsteroidBeltsAsteroidBeltIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<UniverseBloodlinesGetItem>>
     */
    public function getUniverseBloodlines(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/bloodlines', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => UniverseBloodlinesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseCategories(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/categories', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<UniverseCategoriesCategoryIdGet>
     */
    public function getUniverseCategoriesCategoryId(int $categoryId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/categories/{category_id}', ['category_id' => $categoryId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseCategoriesCategoryIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseConstellations(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/constellations', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<UniverseConstellationsConstellationIdGet>
     */
    public function getUniverseConstellationsConstellationId(int $constellationId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/constellations/{constellation_id}', ['constellation_id' => $constellationId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseConstellationsConstellationIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<UniverseFactionsGetItem>>
     */
    public function getUniverseFactions(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/factions', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => UniverseFactionsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseGraphics(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/graphics', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<UniverseGraphicsGraphicIdGet>
     */
    public function getUniverseGraphicsGraphicId(int $graphicId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/graphics/{graphic_id}', ['graphic_id' => $graphicId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseGraphicsGraphicIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     * @paginated Use $page param to iterate pages.
     */
    public function getUniverseGroups(int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/groups', [], 'latest', ['page' => $page]);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<UniverseGroupsGroupIdGet>
     */
    public function getUniverseGroupsGroupId(int $groupId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/groups/{group_id}', ['group_id' => $groupId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseGroupsGroupIdGet::from($response->data));
    }

    /**
     * @return EsiResult<UniverseIdsPost>
     */
    public function postUniverseIds(mixed $requestBody): EsiResult
    {
        $response = $this->client->invoke('post', '/universe/ids', [], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, UniverseIdsPost::from($response->data));
    }

    /**
     * @return EsiResult<UniverseMoonsMoonIdGet>
     */
    public function getUniverseMoonsMoonId(int $moonId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/moons/{moon_id}', ['moon_id' => $moonId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseMoonsMoonIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<UniverseNamesPostItem>>
     */
    public function postUniverseNames(mixed $requestBody): EsiResult
    {
        $response = $this->client->invoke('post', '/universe/names', [], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => UniverseNamesPostItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<UniversePlanetsPlanetIdGet>
     */
    public function getUniversePlanetsPlanetId(int $planetId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/planets/{planet_id}', ['planet_id' => $planetId], 'latest', []);
        return EsiResult::fromResponse($response, UniversePlanetsPlanetIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<UniverseRacesGetItem>>
     */
    public function getUniverseRaces(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/races', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => UniverseRacesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseRegions(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/regions', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<UniverseRegionsRegionIdGet>
     */
    public function getUniverseRegionsRegionId(int $regionId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/regions/{region_id}', ['region_id' => $regionId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseRegionsRegionIdGet::from($response->data));
    }

    /**
     * @return EsiResult<UniverseStargatesStargateIdGet>
     */
    public function getUniverseStargatesStargateId(int $stargateId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/stargates/{stargate_id}', ['stargate_id' => $stargateId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseStargatesStargateIdGet::from($response->data));
    }

    /**
     * @return EsiResult<UniverseStarsStarIdGet>
     */
    public function getUniverseStarsStarId(int $starId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/stars/{star_id}', ['star_id' => $starId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseStarsStarIdGet::from($response->data));
    }

    /**
     * @return EsiResult<UniverseStationsStationIdGet>
     */
    public function getUniverseStationsStationId(int $stationId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/stations/{station_id}', ['station_id' => $stationId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseStationsStationIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseStructures(?string $filter = null): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/structures', [], 'latest', ['filter' => $filter]);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<UniverseStructuresStructureIdGet>
     * @scope esi-universe.read_structures.v1
     */
    public function getUniverseStructuresStructureId(int $structureId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/structures/{structure_id}', ['structure_id' => $structureId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseStructuresStructureIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<UniverseSystemJumpsGetItem>>
     */
    public function getUniverseSystemJumps(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/system_jumps', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => UniverseSystemJumpsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<UniverseSystemKillsGetItem>>
     */
    public function getUniverseSystemKills(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/system_kills', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => UniverseSystemKillsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getUniverseSystems(): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/systems', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<UniverseSystemsSystemIdGet>
     */
    public function getUniverseSystemsSystemId(int $systemId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/systems/{system_id}', ['system_id' => $systemId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseSystemsSystemIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     * @paginated Use $page param to iterate pages.
     */
    public function getUniverseTypes(int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/types', [], 'latest', ['page' => $page]);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<UniverseTypesTypeIdGet>
     */
    public function getUniverseTypesTypeId(int $typeId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/types/{type_id}', ['type_id' => $typeId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseTypesTypeIdGet::from($response->data));
    }
}