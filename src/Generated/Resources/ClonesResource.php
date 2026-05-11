<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdClonesGet;

/**
 * ESI tag: Clones
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class ClonesResource extends AbstractResource
{
    /**
     * @return EsiResult<CharactersCharacterIdClonesGet>
     * @scope esi-clones.read_clones.v1
     */
    public function getCharactersCharacterIdClones(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/clones', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersCharacterIdClonesGet::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     * @scope esi-clones.read_implants.v1
     */
    public function getCharactersCharacterIdImplants(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/implants', ['character_id' => $characterId], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }
}