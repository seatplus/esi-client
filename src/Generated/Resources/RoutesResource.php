<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Route;

/**
 * ESI tag: Routes
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class RoutesResource extends AbstractResource
{
    /**
     * @return EsiResult<Route>
     */
    public function postRoute(mixed $requestBody, int $originSystemId, int $destinationSystemId): EsiResult
    {
        $response = $this->client->invoke('post', '/route/{origin_system_id}/{destination_system_id}', ['origin_system_id' => $originSystemId, 'destination_system_id' => $destinationSystemId], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, Route::from($response->data));
    }
}