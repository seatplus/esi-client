<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction\GetCharactersCharacterIdPlanetsItem;
use Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction\GetCharactersCharacterIdPlanetsPlanetIdResponse;
use Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction\GetCorporationsCorporationIdCustomsOfficesItem;
use Seatplus\EsiClient\Generated\Responses\PlanetaryInteraction\GetUniverseSchematicsSchematicIdResponse;

/**
 * ESI tag: Planetary Interaction
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class PlanetaryInteractionResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdPlanetsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdPlanets(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/planets/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdPlanetsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdPlanetsPlanetIdResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdPlanetsPlanetId(int $characterId, int $planetId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/planets/{planet_id}/', ['character_id' => $characterId, 'planet_id' => $planetId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdPlanetsPlanetIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdCustomsOfficesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdCustomsOffices(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/customs_offices/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdCustomsOfficesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetUniverseSchematicsSchematicIdResponse>
     */
    public function getUniverseSchematicsSchematicId(int $schematicId): EsiResult
    {
        $response = $this->client->invoke('get', '/universe/schematics/{schematic_id}/', ['schematic_id' => $schematicId], 'latest', []);
        return EsiResult::fromResponse($response, GetUniverseSchematicsSchematicIdResponse::from($response->data));
    }
}