<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdPlanetsGetItem;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdPlanetsPlanetIdGet;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdCustomsOfficesGetItem;
use Seatplus\EsiSchema\Responses\UniverseSchematicsSchematicIdGet;

/**
 * ESI tag: PlanetaryInteraction
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class PlanetaryInteractionResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdPlanetsGetItem>>
     *
     * @scope esi-planets.manage_planets.v1
     */
    public function getCharactersCharacterIdPlanets(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/planets', ['character_id' => $characterId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdPlanetsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @scope esi-planets.manage_planets.v1
     */
    public function getCharactersCharacterIdPlanetsPlanetId(int $characterId, int $planetId): CharactersCharacterIdPlanetsPlanetIdGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/planets/{planet_id}', ['character_id' => $characterId, 'planet_id' => $planetId], 'latest', []);
        $dto = CharactersCharacterIdPlanetsPlanetIdGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdCustomsOfficesGetItem>>
     *
     * @scope esi-planets.read_customs_offices.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdCustomsOffices(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/customs_offices', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdCustomsOfficesGetItem::from($item),
            (array) $response->data,
        ));
    }

    public function getUniverseSchematicsSchematicId(int $schematicId): UniverseSchematicsSchematicIdGet
    {
        $response = $this->client->invoke('get', '/universe/schematics/{schematic_id}', ['schematic_id' => $schematicId], 'latest', []);
        $dto = UniverseSchematicsSchematicIdGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }
}
