<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdMailGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdMailLabelsGet;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdMailListsGetItem;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdMailMailIdGet;

/**
 * ESI tag: Mail
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class MailResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdMailGetItem>>
     * @scope esi-mail.read_mail.v1
     */
    public function getCharactersCharacterIdMail(int $characterId, ?array $labels = null, ?int $lastMailId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mail', ['character_id' => $characterId], 'latest', ['labels' => $labels, 'last_mail_id' => $lastMailId]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdMailGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @scope esi-mail.send_mail.v1
     */
    public function postCharactersCharacterIdMail(mixed $requestBody, int $characterId): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/mail', ['character_id' => $characterId], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<CharactersCharacterIdMailLabelsGet>
     * @scope esi-mail.read_mail.v1
     */
    public function getCharactersCharacterIdMailLabels(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mail/labels', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdMailLabelsGet::from($response->data));
    }

    /**
     * @return EsiResult<null>
     * @scope esi-mail.organize_mail.v1
     */
    public function postCharactersCharacterIdMailLabels(mixed $requestBody, int $characterId): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/mail/labels', ['character_id' => $characterId], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @scope esi-mail.organize_mail.v1
     */
    public function deleteCharactersCharacterIdMailLabelsLabelId(int $characterId, int $labelId): EsiResult
    {
        $response = $this->client->invoke('delete', '/characters/{character_id}/mail/labels/{label_id}', ['character_id' => $characterId, 'label_id' => $labelId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdMailListsGetItem>>
     * @scope esi-mail.read_mail.v1
     */
    public function getCharactersCharacterIdMailLists(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mail/lists', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdMailListsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @scope esi-mail.organize_mail.v1
     */
    public function deleteCharactersCharacterIdMailMailId(int $characterId, int $mailId): EsiResult
    {
        $response = $this->client->invoke('delete', '/characters/{character_id}/mail/{mail_id}', ['character_id' => $characterId, 'mail_id' => $mailId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<CharactersCharacterIdMailMailIdGet>
     * @scope esi-mail.read_mail.v1
     */
    public function getCharactersCharacterIdMailMailId(int $characterId, int $mailId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mail/{mail_id}', ['character_id' => $characterId, 'mail_id' => $mailId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdMailMailIdGet::from($response->data));
    }

    /**
     * @return EsiResult<null>
     * @scope esi-mail.organize_mail.v1
     */
    public function putCharactersCharacterIdMailMailId(mixed $requestBody, int $characterId, int $mailId): EsiResult
    {
        $response = $this->client->invoke('put', '/characters/{character_id}/mail/{mail_id}', ['character_id' => $characterId, 'mail_id' => $mailId], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, null);
    }
}