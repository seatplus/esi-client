<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\DogmaAttributesAttributeIdGet;
use Seatplus\EsiClient\Generated\Responses\DogmaDynamicItemsTypeIdItemIdGet;
use Seatplus\EsiClient\Generated\Responses\DogmaEffectsEffectIdGet;

/**
 * ESI tag: Dogma
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class DogmaResource extends AbstractResource
{
    /**
     * @return EsiResult<array<int>>
     */
    public function getDogmaAttributes(): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/attributes', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<DogmaAttributesAttributeIdGet>
     */
    public function getDogmaAttributesAttributeId(int $attributeId): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/attributes/{attribute_id}', ['attribute_id' => $attributeId], 'latest', []);
        return EsiResult::fromResponse($response, DogmaAttributesAttributeIdGet::from($response->data));
    }

    /**
     * @return EsiResult<DogmaDynamicItemsTypeIdItemIdGet>
     */
    public function getDogmaDynamicItemsTypeIdItemId(int $itemId, int $typeId): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/dynamic/items/{type_id}/{item_id}', ['item_id' => $itemId, 'type_id' => $typeId], 'latest', []);
        return EsiResult::fromResponse($response, DogmaDynamicItemsTypeIdItemIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getDogmaEffects(): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/effects', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<DogmaEffectsEffectIdGet>
     */
    public function getDogmaEffectsEffectId(int $effectId): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/effects/{effect_id}', ['effect_id' => $effectId], 'latest', []);
        return EsiResult::fromResponse($response, DogmaEffectsEffectIdGet::from($response->data));
    }
}