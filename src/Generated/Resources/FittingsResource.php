<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersCharacterIdFittingsGetItem;

/**
 * ESI tag: Fittings
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class FittingsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdFittingsGetItem>>
     * @scope esi-fittings.read_fittings.v1
     */
    public function getCharactersCharacterIdFittings(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/fittings', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CharactersCharacterIdFittingsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<null>
     * @scope esi-fittings.write_fittings.v1
     */
    public function postCharactersCharacterIdFittings(mixed $requestBody, int $characterId): EsiResult
    {
        $response = $this->client->invoke('post', '/characters/{character_id}/fittings', ['character_id' => $characterId], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @scope esi-fittings.write_fittings.v1
     */
    public function deleteCharactersCharacterIdFittingsFittingId(int $characterId, int $fittingId): EsiResult
    {
        $response = $this->client->invoke('delete', '/characters/{character_id}/fittings/{fitting_id}', ['character_id' => $characterId, 'fitting_id' => $fittingId], 'latest', [], []);
        return EsiResult::fromResponse($response, null);
    }
}