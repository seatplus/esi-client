<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Assets\GetCharactersCharacterIdAssetsItem;
use Seatplus\EsiClient\Generated\Responses\Assets\GetCorporationsCorporationIdAssetsItem;
use Seatplus\EsiClient\Generated\Responses\Assets\PostCharactersCharacterIdAssetsLocationsItem;
use Seatplus\EsiClient\Generated\Responses\Assets\PostCharactersCharacterIdAssetsNamesItem;
use Seatplus\EsiClient\Generated\Responses\Assets\PostCorporationsCorporationIdAssetsLocationsItem;
use Seatplus\EsiClient\Generated\Responses\Assets\PostCorporationsCorporationIdAssetsNamesItem;

/**
 * ESI tag: Assets
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class AssetsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdAssetsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCharactersCharacterIdAssets(int $characterId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/assets/', ['character_id' => $characterId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdAssetsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<PostCharactersCharacterIdAssetsLocationsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCharactersCharacterIdAssetsLocations(int $characterId, mixed $itemIds): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/assets/locations/', ['character_id' => $characterId], 'latest', [], (array) $itemIds);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => PostCharactersCharacterIdAssetsLocationsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<PostCharactersCharacterIdAssetsNamesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCharactersCharacterIdAssetsNames(int $characterId, mixed $itemIds): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/assets/names/', ['character_id' => $characterId], 'latest', [], (array) $itemIds);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => PostCharactersCharacterIdAssetsNamesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdAssetsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdAssets(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/assets/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdAssetsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<PostCorporationsCorporationIdAssetsLocationsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCorporationsCorporationIdAssetsLocations(int $corporationId, mixed $itemIds): EsiResult
    {
        $response = $this->client->invoke('post', '/corporations/{corporation_id}/assets/locations/', ['corporation_id' => $corporationId], 'latest', [], (array) $itemIds);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => PostCorporationsCorporationIdAssetsLocationsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<PostCorporationsCorporationIdAssetsNamesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCorporationsCorporationIdAssetsNames(int $corporationId, mixed $itemIds): EsiResult
    {
        $response = $this->client->invoke('post', '/corporations/{corporation_id}/assets/names/', ['corporation_id' => $corporationId], 'latest', [], (array) $itemIds);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => PostCorporationsCorporationIdAssetsNamesItem::from($item),
            (array) $response->data,
        ));
    }
}