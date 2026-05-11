<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Search\GetCharactersCharacterIdSearchResponse;

/**
 * ESI tag: Search
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class SearchResource extends AbstractResource
{
    /**
     * @return EsiResult<GetCharactersCharacterIdSearchResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdSearch(int $characterId, array $categories, string $search, ?string $language = null, ?bool $strict = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/search/', ['character_id' => $characterId], 'latest', ['categories' => $categories, 'search' => $search, 'language' => $language, 'strict' => $strict]);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdSearchResponse::from($response->data));
    }
}