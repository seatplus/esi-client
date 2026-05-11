<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Killmails\GetCharactersCharacterIdKillmailsRecentItem;
use Seatplus\EsiClient\Generated\Responses\Killmails\GetCorporationsCorporationIdKillmailsRecentItem;
use Seatplus\EsiClient\Generated\Responses\Killmails\GetKillmailsKillmailIdKillmailHashResponse;

/**
 * ESI tag: Killmails
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class KillmailsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdKillmailsRecentItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCharactersCharacterIdKillmailsRecent(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/killmails/recent/', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdKillmailsRecentItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdKillmailsRecentItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdKillmailsRecent(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/killmails/recent/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdKillmailsRecentItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetKillmailsKillmailIdKillmailHashResponse>
     */
    public function getKillmailsKillmailIdKillmailHash(string $killmailHash, int $killmailId): EsiResult
    {
        $response = $this->client->invoke('get', '/killmails/{killmail_id}/{killmail_hash}/', ['killmail_hash' => $killmailHash, 'killmail_id' => $killmailId], 'latest', []);
        return EsiResult::fromResponse($response, GetKillmailsKillmailIdKillmailHashResponse::from($response->data));
    }
}