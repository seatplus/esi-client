<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdLocationGet;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdOnlineGet;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdShipGet;

/**
 * ESI tag: Location
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class LocationResource extends AbstractResource
{
    /**
     * @return EsiResult<CharactersCharacterIdLocationGet>
     * @scope esi-location.read_location.v1
     */
    public function getCharactersCharacterIdLocation(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/location', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdLocationGet::from($response->data));
    }

    /**
     * @return EsiResult<CharactersCharacterIdOnlineGet>
     * @scope esi-location.read_online.v1
     */
    public function getCharactersCharacterIdOnline(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/online', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdOnlineGet::from($response->data));
    }

    /**
     * @return EsiResult<CharactersCharacterIdShipGet>
     * @scope esi-location.read_ship_type.v1
     */
    public function getCharactersCharacterIdShip(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/ship', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdShipGet::from($response->data));
    }
}