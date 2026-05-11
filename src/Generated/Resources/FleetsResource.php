<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Fleets\GetCharactersCharacterIdFleetResponse;
use Seatplus\EsiClient\Generated\Responses\Fleets\GetFleetsFleetIdMembersItem;
use Seatplus\EsiClient\Generated\Responses\Fleets\GetFleetsFleetIdResponse;
use Seatplus\EsiClient\Generated\Responses\Fleets\GetFleetsFleetIdWingsItem;

/**
 * ESI tag: Fleets
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class FleetsResource extends AbstractResource
{
    /**
     * @return EsiResult<GetCharactersCharacterIdFleetResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdFleet(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fleet/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdFleetResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetFleetsFleetIdResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getFleetsFleetId(int $fleetId): EsiResult
    {
        $response = $this->client->invoke('get', '/fleets/{fleet_id}/', ['fleet_id' => $fleetId], 'latest', []);
        return EsiResult::fromResponse($response, GetFleetsFleetIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function putFleetsFleetId(int $fleetId, mixed $newSettings): EsiResult
    {
        $response = $this->client->invoke('put', '/fleets/{fleet_id}/', ['fleet_id' => $fleetId], 'latest', [], (array) $newSettings);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<GetFleetsFleetIdMembersItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getFleetsFleetIdMembers(int $fleetId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/fleets/{fleet_id}/members/', ['fleet_id' => $fleetId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetFleetsFleetIdMembersItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postFleetsFleetIdMembers(int $fleetId, mixed $invitation): EsiResult
    {
        $response = $this->client->invoke('post', '/fleets/{fleet_id}/members/', ['fleet_id' => $fleetId], 'latest', [], (array) $invitation);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function putFleetsFleetIdMembersMemberId(int $fleetId, int $memberId, mixed $movement): EsiResult
    {
        $response = $this->client->invoke('put', '/fleets/{fleet_id}/members/{member_id}/', ['fleet_id' => $fleetId, 'member_id' => $memberId], 'latest', [], (array) $movement);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function deleteFleetsFleetIdMembersMemberId(int $fleetId, int $memberId): EsiResult
    {
        $response = $this->client->invoke('delete', '/fleets/{fleet_id}/members/{member_id}/', ['fleet_id' => $fleetId, 'member_id' => $memberId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function putFleetsFleetIdSquadsSquadId(int $fleetId, int $squadId, mixed $naming): EsiResult
    {
        $response = $this->client->invoke('put', '/fleets/{fleet_id}/squads/{squad_id}/', ['fleet_id' => $fleetId, 'squad_id' => $squadId], 'latest', [], (array) $naming);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function deleteFleetsFleetIdSquadsSquadId(int $fleetId, int $squadId): EsiResult
    {
        $response = $this->client->invoke('delete', '/fleets/{fleet_id}/squads/{squad_id}/', ['fleet_id' => $fleetId, 'squad_id' => $squadId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<GetFleetsFleetIdWingsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getFleetsFleetIdWings(int $fleetId, ?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/fleets/{fleet_id}/wings/', ['fleet_id' => $fleetId], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetFleetsFleetIdWingsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postFleetsFleetIdWings(int $fleetId): EsiResult
    {
        $response = $this->client->invoke('post', '/fleets/{fleet_id}/wings/', ['fleet_id' => $fleetId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function putFleetsFleetIdWingsWingId(int $fleetId, int $wingId, mixed $naming): EsiResult
    {
        $response = $this->client->invoke('put', '/fleets/{fleet_id}/wings/{wing_id}/', ['fleet_id' => $fleetId, 'wing_id' => $wingId], 'latest', [], (array) $naming);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function deleteFleetsFleetIdWingsWingId(int $fleetId, int $wingId): EsiResult
    {
        $response = $this->client->invoke('delete', '/fleets/{fleet_id}/wings/{wing_id}/', ['fleet_id' => $fleetId, 'wing_id' => $wingId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postFleetsFleetIdWingsWingIdSquads(int $fleetId, int $wingId): EsiResult
    {
        $response = $this->client->invoke('post', '/fleets/{fleet_id}/wings/{wing_id}/squads/', ['fleet_id' => $fleetId, 'wing_id' => $wingId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }
}