<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\WarsWarIdGet;
use Seatplus\EsiClient\Generated\Responses\WarsWarIdKillmailsGetItem;

/**
 * ESI tag: Wars
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class WarsResource extends AbstractResource
{
    /**
     * @return EsiResult<array<int>>
     */
    public function getWars(?int $maxWarId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/wars', [], 'latest', ['max_war_id' => $maxWarId]);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<WarsWarIdGet>
     */
    public function getWarsWarId(int $warId): EsiResult
    {
        $response = $this->client->invoke('get', '/wars/{war_id}', ['war_id' => $warId], 'latest', []);
        return EsiResult::fromResponse($response, WarsWarIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<WarsWarIdKillmailsGetItem>>
     * @paginated Use $page param to iterate pages.
     */
    public function getWarsWarIdKillmails(int $warId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/wars/{war_id}/killmails', ['war_id' => $warId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => WarsWarIdKillmailsGetItem::from($item),
            (array) $response->data,
        ));
    }
}