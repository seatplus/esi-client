<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Insurance\GetInsurancePricesItem;

/**
 * ESI tag: Insurance
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class InsuranceResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetInsurancePricesItem>>
     */
    public function getInsurancePrices(?string $language = null): EsiResult
    {
        $response = $this->client->invoke('get', '/insurance/prices/', [], 'latest', ['language' => $language]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetInsurancePricesItem::from($item),
            (array) $response->data,
        ));
    }
}