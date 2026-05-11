<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiSchema\Responses\CharactersCharacterIdSearchGet;

/**
 * ESI tag: Search
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class SearchResource extends AbstractResource
{
    /**
     * @scope esi-search.search_structures.v1
     */
    public function getCharactersCharacterIdSearch(array $categories, int $characterId, string $search, ?bool $strict = null): CharactersCharacterIdSearchGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/search', ['character_id' => $characterId], 'latest', ['categories' => $categories, 'search' => $search, 'strict' => $strict]);
        $dto = CharactersCharacterIdSearchGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }
}
