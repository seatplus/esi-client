<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Status\GetStatusResponse;

/**
 * ESI tag: Status
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class StatusResource extends AbstractResource
{
    /**
     * @return EsiResult<GetStatusResponse>
     */
    public function getStatus(): EsiResult
    {
        $response = $this->client->invoke('get', '/status/', [], 'latest', []);
        return EsiResult::fromResponse($response, GetStatusResponse::from($response->data));
    }
}