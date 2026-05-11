<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdLoyaltyPointsGetItem;
use Seatplus\EsiClient\Generated\Responses\LoyaltyStoresCorporationIdOffersGetItem;

/**
 * ESI tag: Loyalty
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class LoyaltyResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdLoyaltyPointsGetItem>>
     * @scope esi-characters.read_loyalty.v1
     */
    public function getCharactersCharacterIdLoyaltyPoints(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/loyalty/points', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdLoyaltyPointsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<LoyaltyStoresCorporationIdOffersGetItem>>
     */
    public function getLoyaltyStoresCorporationIdOffers(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/loyalty/stores/{corporation_id}/offers', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => LoyaltyStoresCorporationIdOffersGetItem::from($item),
            (array) $response->data,
        ));
    }
}