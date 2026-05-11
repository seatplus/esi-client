<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Loyalty\GetCharactersCharacterIdLoyaltyPointsItem;
use Seatplus\EsiClient\Generated\Responses\Loyalty\GetLoyaltyStoresCorporationIdOffersItem;

/**
 * ESI tag: Loyalty
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class LoyaltyResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdLoyaltyPointsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdLoyaltyPoints(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/loyalty/points/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdLoyaltyPointsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetLoyaltyStoresCorporationIdOffersItem>>
     */
    public function getLoyaltyStoresCorporationIdOffers(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/loyalty/stores/{corporation_id}/offers/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetLoyaltyStoresCorporationIdOffersItem::from($item),
            (array) $response->data,
        ));
    }
}