<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Dogma\GetDogmaAttributesAttributeIdResponse;
use Seatplus\EsiClient\Generated\Responses\Dogma\GetDogmaDynamicItemsTypeIdItemIdResponse;
use Seatplus\EsiClient\Generated\Responses\Dogma\GetDogmaEffectsEffectIdResponse;

/**
 * ESI tag: Dogma
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class DogmaResource extends AbstractResource
{
    /**
     * @return EsiResult<array<int>>
     */
    public function getDogmaAttributes(): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/attributes/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetDogmaAttributesAttributeIdResponse>
     */
    public function getDogmaAttributesAttributeId(int $attributeId): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/attributes/{attribute_id}/', ['attribute_id' => $attributeId], 'latest', []);
        return EsiResult::fromResponse($response, GetDogmaAttributesAttributeIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<GetDogmaDynamicItemsTypeIdItemIdResponse>
     */
    public function getDogmaDynamicItemsTypeIdItemId(int $itemId, int $typeId): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/dynamic/items/{type_id}/{item_id}/', ['item_id' => $itemId, 'type_id' => $typeId], 'latest', []);
        return EsiResult::fromResponse($response, GetDogmaDynamicItemsTypeIdItemIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<int>>
     */
    public function getDogmaEffects(): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/effects/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetDogmaEffectsEffectIdResponse>
     */
    public function getDogmaEffectsEffectId(int $effectId): EsiResult
    {
        $response = $this->client->invoke('get', '/dogma/effects/{effect_id}/', ['effect_id' => $effectId], 'latest', []);
        return EsiResult::fromResponse($response, GetDogmaEffectsEffectIdResponse::from($response->data));
    }
}