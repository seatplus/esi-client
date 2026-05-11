<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Clones\GetCharactersCharacterIdClonesResponse;

/**
 * ESI tag: Clones
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class ClonesResource extends AbstractResource
{
    /**
     * @return EsiResult<GetCharactersCharacterIdClonesResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdClones(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/clones/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdClonesResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdImplants(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/implants/', ['character_id' => $characterId], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }
}