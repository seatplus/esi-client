<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdFleetGet;
use Seatplus\EsiSchema\Responses\FleetsFleetIdGet;
use Seatplus\EsiSchema\Responses\FleetsFleetIdMembersGetItem;
use Seatplus\EsiSchema\Responses\FleetsFleetIdWingsGetItem;

/**
 * ESI tag: Fleets
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class FleetsResource extends AbstractResource
{
    /**
     * @scope esi-fleets.read_fleet.v1
     */
    public function getCharactersCharacterIdFleet(int $characterId): CharactersCharacterIdFleetGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fleet', ['character_id' => $characterId], 'latest', []);
        $dto = CharactersCharacterIdFleetGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-fleets.read_fleet.v1
     */
    public function getFleetsFleetId(int $fleetId): FleetsFleetIdGet
    {
        $response = $this->client->invoke('get', '/fleets/{fleet_id}', ['fleet_id' => $fleetId], 'latest', []);
        $dto = FleetsFleetIdGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function putFleetsFleetId(mixed $requestBody, int $fleetId): EsiResult
    {
        $response = $this->client->invoke('put', '/fleets/{fleet_id}', ['fleet_id' => $fleetId], 'latest', [], (array) $requestBody);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<FleetsFleetIdMembersGetItem>>
     *
     * @scope esi-fleets.read_fleet.v1
     */
    public function getFleetsFleetIdMembers(int $fleetId): EsiResult
    {
        $response = $this->client->invoke('get', '/fleets/{fleet_id}/members', ['fleet_id' => $fleetId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => FleetsFleetIdMembersGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function postFleetsFleetIdMembers(mixed $requestBody, int $fleetId): EsiResult
    {
        $response = $this->client->invoke('post', '/fleets/{fleet_id}/members', ['fleet_id' => $fleetId], 'latest', [], (array) $requestBody);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function deleteFleetsFleetIdMembersMemberId(int $fleetId, int $memberId): EsiResult
    {
        $response = $this->client->invoke('delete', '/fleets/{fleet_id}/members/{member_id}', ['fleet_id' => $fleetId, 'member_id' => $memberId], 'latest', [], []);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function putFleetsFleetIdMembersMemberId(mixed $requestBody, int $fleetId, int $memberId): EsiResult
    {
        $response = $this->client->invoke('put', '/fleets/{fleet_id}/members/{member_id}', ['fleet_id' => $fleetId, 'member_id' => $memberId], 'latest', [], (array) $requestBody);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function deleteFleetsFleetIdSquadsSquadId(int $fleetId, int $squadId): EsiResult
    {
        $response = $this->client->invoke('delete', '/fleets/{fleet_id}/squads/{squad_id}', ['fleet_id' => $fleetId, 'squad_id' => $squadId], 'latest', [], []);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function putFleetsFleetIdSquadsSquadId(mixed $requestBody, int $fleetId, int $squadId): EsiResult
    {
        $response = $this->client->invoke('put', '/fleets/{fleet_id}/squads/{squad_id}', ['fleet_id' => $fleetId, 'squad_id' => $squadId], 'latest', [], (array) $requestBody);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<FleetsFleetIdWingsGetItem>>
     *
     * @scope esi-fleets.read_fleet.v1
     */
    public function getFleetsFleetIdWings(int $fleetId): EsiResult
    {
        $response = $this->client->invoke('get', '/fleets/{fleet_id}/wings', ['fleet_id' => $fleetId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => FleetsFleetIdWingsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function postFleetsFleetIdWings(int $fleetId): EsiResult
    {
        $response = $this->client->invoke('post', '/fleets/{fleet_id}/wings', ['fleet_id' => $fleetId], 'latest', [], []);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function deleteFleetsFleetIdWingsWingId(int $fleetId, int $wingId): EsiResult
    {
        $response = $this->client->invoke('delete', '/fleets/{fleet_id}/wings/{wing_id}', ['fleet_id' => $fleetId, 'wing_id' => $wingId], 'latest', [], []);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function putFleetsFleetIdWingsWingId(mixed $requestBody, int $fleetId, int $wingId): EsiResult
    {
        $response = $this->client->invoke('put', '/fleets/{fleet_id}/wings/{wing_id}', ['fleet_id' => $fleetId, 'wing_id' => $wingId], 'latest', [], (array) $requestBody);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-fleets.write_fleet.v1
     */
    public function postFleetsFleetIdWingsWingIdSquads(int $fleetId, int $wingId): EsiResult
    {
        $response = $this->client->invoke('post', '/fleets/{fleet_id}/wings/{wing_id}/squads', ['fleet_id' => $fleetId, 'wing_id' => $wingId], 'latest', [], []);

        return EsiResult::fromResponse($response, null);
    }
}
