<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Wallet\GetCharactersCharacterIdWalletJournalItem;
use Seatplus\EsiClient\Generated\Responses\Wallet\GetCharactersCharacterIdWalletTransactionsItem;
use Seatplus\EsiClient\Generated\Responses\Wallet\GetCorporationsCorporationIdWalletsDivisionJournalItem;
use Seatplus\EsiClient\Generated\Responses\Wallet\GetCorporationsCorporationIdWalletsDivisionTransactionsItem;
use Seatplus\EsiClient\Generated\Responses\Wallet\GetCorporationsCorporationIdWalletsItem;

/**
 * ESI tag: Wallet
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class WalletResource extends AbstractResource
{
    /**
     * @return EsiResult<float>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdWallet(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/wallet/', ['character_id' => $characterId], 'latest', []);
        /** @var float $scalar */
        $scalar = json_decode($response->raw);
        return EsiResult::fromResponse($response, $scalar);
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdWalletJournalItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCharactersCharacterIdWalletJournal(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/wallet/journal/', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdWalletJournalItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdWalletTransactionsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdWalletTransactions(int $characterId, ?int $fromId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/wallet/transactions/', ['character_id' => $characterId], 'latest', ['from_id' => $fromId]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdWalletTransactionsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdWalletsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdWallets(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/wallets/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdWalletsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdWalletsDivisionJournalItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdWalletsDivisionJournal(int $corporationId, int $division, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/wallets/{division}/journal/', ['corporation_id' => $corporationId, 'division' => $division], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdWalletsDivisionJournalItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdWalletsDivisionTransactionsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdWalletsDivisionTransactions(int $corporationId, int $division, ?int $fromId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/wallets/{division}/transactions/', ['corporation_id' => $corporationId, 'division' => $division], 'latest', ['from_id' => $fromId]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdWalletsDivisionTransactionsItem::from($item),
            (array) $response->data,
        ));
    }
}