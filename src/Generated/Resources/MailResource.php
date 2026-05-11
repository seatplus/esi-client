<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Mail\GetCharactersCharacterIdMailItem;
use Seatplus\EsiClient\Generated\Responses\Mail\GetCharactersCharacterIdMailLabelsResponse;
use Seatplus\EsiClient\Generated\Responses\Mail\GetCharactersCharacterIdMailListsItem;
use Seatplus\EsiClient\Generated\Responses\Mail\GetCharactersCharacterIdMailMailIdResponse;

/**
 * ESI tag: Mail
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class MailResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdMailItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdMail(int $characterId, ?array $labels = null, ?int $lastMailId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mail/', ['character_id' => $characterId], 'latest', ['labels' => $labels, 'last_mail_id' => $lastMailId]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdMailItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCharactersCharacterIdMail(int $characterId, mixed $mail): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/mail/', ['character_id' => $characterId], 'latest', [], (array) $mail);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdMailLabelsResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdMailLabels(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mail/labels/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdMailLabelsResponse::from($response->data));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCharactersCharacterIdMailLabels(int $characterId, mixed $label): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/mail/labels/', ['character_id' => $characterId], 'latest', [], (array) $label);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function deleteCharactersCharacterIdMailLabelsLabelId(int $characterId, int $labelId): EsiResult
    {
        $response = $this->client->invoke('delete', '/characters/{character_id}/mail/labels/{label_id}/', ['character_id' => $characterId, 'label_id' => $labelId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdMailListsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdMailLists(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mail/lists/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdMailListsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdMailMailIdResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdMailMailId(int $characterId, int $mailId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/mail/{mail_id}/', ['character_id' => $characterId, 'mail_id' => $mailId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdMailMailIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function putCharactersCharacterIdMailMailId(int $characterId, int $mailId, mixed $contents): EsiResult
    {
        $response = $this->client->invoke('put', '/characters/{character_id}/mail/{mail_id}/', ['character_id' => $characterId, 'mail_id' => $mailId], 'latest', [], (array) $contents);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function deleteCharactersCharacterIdMailMailId(int $characterId, int $mailId): EsiResult
    {
        $response = $this->client->invoke('delete', '/characters/{character_id}/mail/{mail_id}/', ['character_id' => $characterId, 'mail_id' => $mailId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }
}