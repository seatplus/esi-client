<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersAffiliationPostItem;
use Seatplus\EsiClient\Generated\Responses\CharactersDetail;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdAgentsResearchGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdBlueprintsGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdCorporationhistoryGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdFatigueGet;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdMedalsGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdNotificationsGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdNotificationsContactsGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdPortraitGet;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdRolesGet;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdStandingsGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdTitlesGetItem;

/**
 * ESI tag: Character
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class CharacterResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersAffiliationPostItem>>
     */
    public function postCharactersAffiliation(mixed $requestBody): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/affiliation', [], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersAffiliationPostItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<CharactersDetail>
     */
    public function getCharactersCharacterId(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersDetail::from($response->data));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdAgentsResearchGetItem>>
     * @scope esi-characters.read_agents_research.v1
     */
    public function getCharactersCharacterIdAgentsResearch(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/agents_research', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdAgentsResearchGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdBlueprintsGetItem>>
     * @scope esi-characters.read_blueprints.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCharactersCharacterIdBlueprints(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/blueprints', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdBlueprintsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdCorporationhistoryGetItem>>
     */
    public function getCharactersCharacterIdCorporationhistory(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/corporationhistory', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdCorporationhistoryGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @scope esi-characters.read_contacts.v1
     */
    public function postCharactersCharacterIdCspa(mixed $requestBody, int $characterId): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/cspa', ['character_id' => $characterId], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<CharactersCharacterIdFatigueGet>
     * @scope esi-characters.read_fatigue.v1
     */
    public function getCharactersCharacterIdFatigue(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fatigue', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdFatigueGet::from($response->data));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdMedalsGetItem>>
     * @scope esi-characters.read_medals.v1
     */
    public function getCharactersCharacterIdMedals(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/medals', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdMedalsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdNotificationsGetItem>>
     * @scope esi-characters.read_notifications.v1
     */
    public function getCharactersCharacterIdNotifications(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/notifications', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdNotificationsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdNotificationsContactsGetItem>>
     * @scope esi-characters.read_notifications.v1
     */
    public function getCharactersCharacterIdNotificationsContacts(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/notifications/contacts', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdNotificationsContactsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<CharactersCharacterIdPortraitGet>
     */
    public function getCharactersCharacterIdPortrait(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/portrait', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdPortraitGet::from($response->data));
    }

    /**
     * @return EsiResult<CharactersCharacterIdRolesGet>
     * @scope esi-characters.read_corporation_roles.v1
     */
    public function getCharactersCharacterIdRoles(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/roles', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdRolesGet::from($response->data));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdStandingsGetItem>>
     * @scope esi-characters.read_standings.v1
     */
    public function getCharactersCharacterIdStandings(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/standings', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdStandingsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdTitlesGetItem>>
     * @scope esi-characters.read_titles.v1
     */
    public function getCharactersCharacterIdTitles(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/titles', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdTitlesGetItem::from($item),
            (array) $response->data,
        ));
    }
}