<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdPlanetsGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdPlanetsPlanetIdGet;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdCustomsOfficesGetItem;
use Seatplus\EsiClient\Generated\Responses\UniverseSchematicsSchematicIdGet;

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
     * @scope esi-planets.manage_planets.v1
     */
    public function getCharactersCharacterIdPlanets(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/planets', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdPlanetsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<CharactersCharacterIdPlanetsPlanetIdGet>
     * @scope esi-planets.manage_planets.v1
     */
    public function getCharactersCharacterIdPlanetsPlanetId(int $characterId, int $planetId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/planets/{planet_id}', ['character_id' => $characterId, 'planet_id' => $planetId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdPlanetsPlanetIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdCustomsOfficesGetItem>>
     * @scope esi-planets.read_customs_offices.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdCustomsOffices(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/customs_offices', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdCustomsOfficesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<UniverseSchematicsSchematicIdGet>
     */
    public function getUniverseSchematicsSchematicId(int $schematicId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/schematics/{schematic_id}', ['schematic_id' => $schematicId], 'latest', []);
        return EsiResult::fromResponse($response, UniverseSchematicsSchematicIdGet::from($response->data));
    }
}