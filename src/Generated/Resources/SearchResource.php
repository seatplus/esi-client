<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdSearchGet;

/**
 * ESI tag: Search
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class SearchResource extends AbstractResource
{
    /**
     * @return EsiResult<CharactersCharacterIdSearchGet>
     * @scope esi-search.search_structures.v1
     */
    public function getCharactersCharacterIdSearch(array $categories, int $characterId, string $search, ?bool $strict = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/search', ['character_id' => $characterId], 'latest', ['categories' => $categories, 'search' => $search, 'strict' => $strict]);
        return EsiResult::fromResponse($response, CharactersCharacterIdSearchGet::from($response->data));
    }
}