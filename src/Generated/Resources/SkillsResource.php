<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdAttributesGet;
use Seatplus\EsiSchema\Responses\CharactersSkills;

/**
 * ESI tag: Skills
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class SkillsResource extends AbstractResource
{
    /**
     * @scope esi-skills.read_skills.v1
     */
    public function getCharactersCharacterIdAttributes(int $characterId): CharactersCharacterIdAttributesGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/attributes', ['character_id' => $characterId], 'latest', []);
        $dto = CharactersCharacterIdAttributesGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-skills.read_skillqueue.v1
     */
    public function getCharactersCharacterIdSkillqueue(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/skillqueue', ['character_id' => $characterId], 'latest', []);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @scope esi-skills.read_skills.v1
     */
    public function getCharactersCharacterIdSkills(int $characterId): CharactersSkills
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/skills', ['character_id' => $characterId], 'latest', []);
        $dto = CharactersSkills::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }
}
