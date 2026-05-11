<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiSchema\Responses\CharactersCharacterIdLocationGet;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdOnlineGet;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdShipGet;

/**
 * ESI tag: Location
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class LocationResource extends AbstractResource
{
    /**
     * @scope esi-location.read_location.v1
     */
    public function getCharactersCharacterIdLocation(int $characterId): CharactersCharacterIdLocationGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/location', ['character_id' => $characterId], 'latest', []);
        $dto = CharactersCharacterIdLocationGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-location.read_online.v1
     */
    public function getCharactersCharacterIdOnline(int $characterId): CharactersCharacterIdOnlineGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/online', ['character_id' => $characterId], 'latest', []);
        $dto = CharactersCharacterIdOnlineGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-location.read_ship_type.v1
     */
    public function getCharactersCharacterIdShip(int $characterId): CharactersCharacterIdShipGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/ship', ['character_id' => $characterId], 'latest', []);
        $dto = CharactersCharacterIdShipGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }
}
