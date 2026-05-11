<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\StatusGet;

/**
 * ESI tag: Status
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class StatusResource extends AbstractResource
{
    /**
     * @return EsiResult<StatusGet>
     */
    public function getStatus(): EsiResult
    {
        $response = $this->client->invoke('get', '/status', [], 'latest', []);
        return EsiResult::fromResponse($response, StatusGet::from($response->data));
    }
}