<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdKillmailsRecentGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdKillmailsRecentGetItem;
use Seatplus\EsiClient\Generated\Responses\KillmailsKillmailIdKillmailHashGet;

/**
 * ESI tag: Killmails
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class KillmailsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdKillmailsRecentGetItem>>
     * @scope esi-killmails.read_killmails.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCharactersCharacterIdKillmailsRecent(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/killmails/recent', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdKillmailsRecentGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdKillmailsRecentGetItem>>
     * @scope esi-killmails.read_corporation_killmails.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdKillmailsRecent(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/killmails/recent', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdKillmailsRecentGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<KillmailsKillmailIdKillmailHashGet>
     */
    public function getKillmailsKillmailIdKillmailHash(string $killmailHash, int $killmailId): EsiResult
    {
        $response = $this->client->invoke('get', '/killmails/{killmail_id}/{killmail_hash}', ['killmail_hash' => $killmailHash, 'killmail_id' => $killmailId], 'latest', []);
        return EsiResult::fromResponse($response, KillmailsKillmailIdKillmailHashGet::from($response->data));
    }
}