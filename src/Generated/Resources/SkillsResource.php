<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdAttributesGet;
use Seatplus\EsiClient\Generated\Responses\CharactersSkills;

/**
 * ESI tag: Skills
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class SkillsResource extends AbstractResource
{
    /**
     * @return EsiResult<CharactersCharacterIdAttributesGet>
     * @scope esi-skills.read_skills.v1
     */
    public function getCharactersCharacterIdAttributes(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/attributes', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdAttributesGet::from($response->data));
    }

    /**
     * @return EsiResult<null>
     * @scope esi-skills.read_skillqueue.v1
     */
    public function getCharactersCharacterIdSkillqueue(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/skillqueue', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<CharactersSkills>
     * @scope esi-skills.read_skills.v1
     */
    public function getCharactersCharacterIdSkills(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/skills', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersSkills::from($response->data));
    }
}