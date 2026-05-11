<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdAgentsResearchItem;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdBlueprintsItem;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdCorporationhistoryItem;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdFatigueResponse;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdMedalsItem;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdNotificationsContactsItem;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdNotificationsItem;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdPortraitResponse;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdResponse;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdRolesResponse;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdStandingsItem;
use Seatplus\EsiClient\Generated\Responses\Character\GetCharactersCharacterIdTitlesItem;
use Seatplus\EsiClient\Generated\Responses\Character\PostCharactersAffiliationItem;

/**
 * ESI tag: Character
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class CharacterResource extends AbstractResource
{
    /**
     * @return EsiResult<array<PostCharactersAffiliationItem>>
     */
    public function postCharactersAffiliation(mixed $characters): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/affiliation/', [], 'latest', [], (array) $characters);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => PostCharactersAffiliationItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdResponse>
     */
    public function getCharactersCharacterId(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdAgentsResearchItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdAgentsResearch(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/agents_research/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdAgentsResearchItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdBlueprintsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCharactersCharacterIdBlueprints(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/blueprints/', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdBlueprintsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdCorporationhistoryItem>>
     */
    public function getCharactersCharacterIdCorporationhistory(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/corporationhistory/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdCorporationhistoryItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCharactersCharacterIdCspa(int $characterId, mixed $characters): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/cspa/', ['character_id' => $characterId], 'latest', [], (array) $characters);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdFatigueResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdFatigue(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fatigue/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdFatigueResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdMedalsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdMedals(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/medals/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdMedalsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdNotificationsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdNotifications(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/notifications/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdNotificationsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdNotificationsContactsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdNotificationsContacts(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/notifications/contacts/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdNotificationsContactsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdPortraitResponse>
     */
    public function getCharactersCharacterIdPortrait(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/portrait/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdPortraitResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdRolesResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdRoles(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/roles/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdRolesResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdStandingsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdStandings(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/standings/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdStandingsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdTitlesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdTitles(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/titles/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdTitlesItem::from($item),
            (array) $response->data,
        ));
    }
}