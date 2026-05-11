<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\AlliancesAllianceIdContactsGetItem;
use Seatplus\EsiSchema\Responses\AlliancesAllianceIdContactsLabelsGetItem;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdContactsGetItem;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdContactsLabelsGetItem;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdContactsGetItem;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdContactsLabelsGetItem;

/**
 * ESI tag: Contacts
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class ContactsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<AlliancesAllianceIdContactsGetItem>>
     *
     * @scope esi-alliances.read_contacts.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getAlliancesAllianceIdContacts(int $allianceId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/contacts', ['alliance_id' => $allianceId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => AlliancesAllianceIdContactsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<AlliancesAllianceIdContactsLabelsGetItem>>
     *
     * @scope esi-alliances.read_contacts.v1
     */
    public function getAlliancesAllianceIdContactsLabels(int $allianceId): EsiResult
    {
        $response = $this->client->invoke('get', '/alliances/{alliance_id}/contacts/labels', ['alliance_id' => $allianceId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => AlliancesAllianceIdContactsLabelsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-characters.write_contacts.v1
     */
    public function deleteCharactersCharacterIdContacts(int $characterId, array $contactIds): EsiResult
    {
        $response = $this->client->invoke('delete', '/characters/{character_id}/contacts', ['character_id' => $characterId], 'latest', ['contact_ids' => $contactIds], []);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdContactsGetItem>>
     *
     * @scope esi-characters.read_contacts.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getCharactersCharacterIdContacts(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contacts', ['character_id' => $characterId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdContactsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-characters.write_contacts.v1
     */
    public function postCharactersCharacterIdContacts(mixed $requestBody, int $characterId, float $standing, ?array $labelIds = null, ?bool $watched = null): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/contacts', ['character_id' => $characterId], 'latest', ['label_ids' => $labelIds, 'standing' => $standing, 'watched' => $watched], (array) $requestBody);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-characters.write_contacts.v1
     */
    public function putCharactersCharacterIdContacts(mixed $requestBody, int $characterId, float $standing, ?array $labelIds = null, ?bool $watched = null): EsiResult
    {
        $response = $this->client->invoke('put', '/characters/{character_id}/contacts', ['character_id' => $characterId], 'latest', ['label_ids' => $labelIds, 'standing' => $standing, 'watched' => $watched], (array) $requestBody);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdContactsLabelsGetItem>>
     *
     * @scope esi-characters.read_contacts.v1
     */
    public function getCharactersCharacterIdContactsLabels(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/contacts/labels', ['character_id' => $characterId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdContactsLabelsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdContactsGetItem>>
     *
     * @scope esi-corporations.read_contacts.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdContacts(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contacts', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdContactsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdContactsLabelsGetItem>>
     *
     * @scope esi-corporations.read_contacts.v1
     */
    public function getCorporationsCorporationIdContactsLabels(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/contacts/labels', ['corporation_id' => $corporationId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdContactsLabelsGetItem::from($item),
            (array) $response->data,
        ));
    }
}
