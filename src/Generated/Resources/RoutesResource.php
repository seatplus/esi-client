<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;

/**
 * ESI tag: Routes
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class RoutesResource extends AbstractResource
{
    /**
     * @return EsiResult<array<int>>
     */
    public function getRouteOriginDestination(int $destination, int $origin, ?array $avoid = null, ?array $connections = null, ?string $flag = null): EsiResult
    {
        $response = $this->client->invoke('get', '/route/{origin}/{destination}/', ['destination' => $destination, 'origin' => $origin], 'latest', ['avoid' => $avoid, 'connections' => $connections, 'flag' => $flag]);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }
}