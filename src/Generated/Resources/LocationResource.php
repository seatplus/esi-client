<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Location\GetCharactersCharacterIdLocationResponse;
use Seatplus\EsiClient\Generated\Responses\Location\GetCharactersCharacterIdOnlineResponse;
use Seatplus\EsiClient\Generated\Responses\Location\GetCharactersCharacterIdShipResponse;

/**
 * ESI tag: Location
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class LocationResource extends AbstractResource
{
    /**
     * @return EsiResult<GetCharactersCharacterIdLocationResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdLocation(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/location/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdLocationResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdOnlineResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdOnline(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/online/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdOnlineResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdShipResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdShip(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/ship/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdShipResponse::from($response->data));
    }
}