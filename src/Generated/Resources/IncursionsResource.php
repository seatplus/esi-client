<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\IncursionsGetItem;

/**
 * ESI tag: Incursions
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class IncursionsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<IncursionsGetItem>>
     */
    public function getIncursions(): EsiResult
    {
        $response = $this->client->invoke('get', '/incursions', [], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => IncursionsGetItem::from($item),
            (array) $response->data,
        ));
    }
}