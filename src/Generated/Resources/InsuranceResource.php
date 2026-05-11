<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\InsurancePricesGetItem;

/**
 * ESI tag: Insurance
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class InsuranceResource extends AbstractResource
{
    /**
     * @return EsiResult<array<InsurancePricesGetItem>>
     */
    public function getInsurancePrices(): EsiResult
    {
        $response = $this->client->invoke('get', '/insurance/prices', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => InsurancePricesGetItem::from($item),
            (array) $response->data,
        ));
    }
}