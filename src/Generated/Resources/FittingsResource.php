<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Fittings\GetCharactersCharacterIdFittingsItem;

/**
 * ESI tag: Fittings
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class FittingsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdFittingsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdFittings(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fittings/', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdFittingsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function postCharactersCharacterIdFittings(int $characterId, mixed $fitting): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/fittings/', ['character_id' => $characterId], 'latest', [], (array) $fitting);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function deleteCharactersCharacterIdFittingsFittingId(int $characterId, int $fittingId): EsiResult
    {
        $response = $this->client->invoke('delete', '/characters/{character_id}/fittings/{fitting_id}/', ['character_id' => $characterId, 'fitting_id' => $fittingId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }
}