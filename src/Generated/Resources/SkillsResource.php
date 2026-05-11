<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Skills\GetCharactersCharacterIdAttributesResponse;
use Seatplus\EsiClient\Generated\Responses\Skills\GetCharactersCharacterIdSkillqueueItem;
use Seatplus\EsiClient\Generated\Responses\Skills\GetCharactersCharacterIdSkillsResponse;

/**
 * ESI tag: Skills
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class SkillsResource extends AbstractResource
{
    /**
     * @return EsiResult<GetCharactersCharacterIdAttributesResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdAttributes(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/attributes/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdAttributesResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdSkillqueueItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdSkillqueue(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/skillqueue/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdSkillqueueItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdSkillsResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdSkills(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/skills/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdSkillsResponse::from($response->data));
    }
}