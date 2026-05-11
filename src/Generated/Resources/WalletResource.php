<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdWalletJournalGetItem;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdWalletTransactionsGetItem;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdWalletsDivisionJournalGetItem;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdWalletsDivisionTransactionsGetItem;
use Seatplus\EsiSchema\Responses\CorporationsCorporationIdWalletsGetItem;

/**
 * ESI tag: Wallet
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class WalletResource extends AbstractResource
{
    /**
     * @return EsiResult<float>
     *
     * @scope esi-wallet.read_character_wallet.v1
     */
    public function getCharactersCharacterIdWallet(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/wallet', ['character_id' => $characterId], 'latest', []);
        /** @var float $scalar */
        $scalar = json_decode($response->raw);

        return EsiResult::fromResponse($response, $scalar);
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdWalletJournalGetItem>>
     *
     * @scope esi-wallet.read_character_wallet.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getCharactersCharacterIdWalletJournal(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/wallet/journal', ['character_id' => $characterId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdWalletJournalGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdWalletTransactionsGetItem>>
     *
     * @scope esi-wallet.read_character_wallet.v1
     */
    public function getCharactersCharacterIdWalletTransactions(int $characterId, ?int $fromId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/wallet/transactions', ['character_id' => $characterId], 'latest', ['from_id' => $fromId]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdWalletTransactionsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdWalletsGetItem>>
     *
     * @scope esi-wallet.read_corporation_wallets.v1
     */
    public function getCorporationsCorporationIdWallets(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/wallets', ['corporation_id' => $corporationId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdWalletsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdWalletsDivisionJournalGetItem>>
     *
     * @scope esi-wallet.read_corporation_wallets.v1
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdWalletsDivisionJournal(int $corporationId, int $division, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/wallets/{division}/journal', ['corporation_id' => $corporationId, 'division' => $division], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdWalletsDivisionJournalGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdWalletsDivisionTransactionsGetItem>>
     *
     * @scope esi-wallet.read_corporation_wallets.v1
     */
    public function getCorporationsCorporationIdWalletsDivisionTransactions(int $corporationId, int $division, ?int $fromId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/wallets/{division}/transactions', ['corporation_id' => $corporationId, 'division' => $division], 'latest', ['from_id' => $fromId]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CorporationsCorporationIdWalletsDivisionTransactionsGetItem::from($item),
            (array) $response->data,
        ));
    }
}
