<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Contacts\GetAlliancesAllianceIdContactsItem;
use Seatplus\EsiClient\Generated\Responses\Contacts\GetAlliancesAllianceIdContactsLabelsItem;
use Seatplus\EsiClient\Generated\Responses\Contacts\GetCharactersCharacterIdContactsItem;
use Seatplus\EsiClient\Generated\Responses\Contacts\GetCharactersCharacterIdContactsLabelsItem;
use Seatplus\EsiClient\Generated\Responses\Contacts\GetCorporationsCorporationIdContactsItem;
use Seatplus\EsiClient\Generated\Responses\Contacts\GetCorporationsCorporationIdContactsLabelsItem;

/**
 * ESI tag: Contacts
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class ContactsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetAlliancesAllianceIdContactsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getAlliancesAllianceIdContacts(int $allianceId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/contacts/', ['alliance_id' => $allianceId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetAlliancesAllianceIdContactsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetAlliancesAllianceIdContactsLabelsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getAlliancesAllianceIdContactsLabels(int $allianceId): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/contacts/labels/', ['alliance_id' => $allianceId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetAlliancesAllianceIdContactsLabelsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdContactsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCharactersCharacterIdContacts(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contacts/', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdContactsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCharactersCharacterIdContacts(int $characterId, float $standing, mixed $contactIds, ?array $labelIds = null, ?bool $watched = null): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/contacts/', ['character_id' => $characterId], 'latest', ['standing' => $standing, 'label_ids' => $labelIds, 'watched' => $watched], (array) $contactIds);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function putCharactersCharacterIdContacts(int $characterId, float $standing, mixed $contactIds, ?array $labelIds = null, ?bool $watched = null): EsiResult
    {
        $response = $this->client->invoke('put', '/characters/{character_id}/contacts/', ['character_id' => $characterId], 'latest', ['standing' => $standing, 'label_ids' => $labelIds, 'watched' => $watched], (array) $contactIds);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function deleteCharactersCharacterIdContacts(int $characterId, array $contactIds): EsiResult
    {
        $response = $this->client->invoke('delete', '/characters/{character_id}/contacts/', ['character_id' => $characterId], 'latest', ['contact_ids' => $contactIds], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdContactsLabelsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdContactsLabels(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contacts/labels/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdContactsLabelsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdContactsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdContacts(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contacts/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdContactsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdContactsLabelsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdContactsLabels(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contacts/labels/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdContactsLabelsItem::from($item),
            (array) $response->data,
        ));
    }
}