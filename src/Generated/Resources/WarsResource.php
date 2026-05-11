<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\WarsWarIdGet;
use Seatplus\EsiSchema\Responses\WarsWarIdKillmailsGetItem;

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
        $data = array_map(fn (mixed $i) => (int) $i, (array) $response->data);

        return EsiResult::fromResponse($response, $data);
    }

    public function getWarsWarId(int $warId): WarsWarIdGet
    {
        $response = $this->client->invoke('get', '/wars/{war_id}', ['war_id' => $warId], 'latest', []);
        $dto = WarsWarIdGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @return EsiResult<array<WarsWarIdKillmailsGetItem>>
     *
     * @paginated Use $page param to iterate pages.
     */
    public function getWarsWarIdKillmails(int $warId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/wars/{war_id}/killmails', ['war_id' => $warId], 'latest', ['page' => $page]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => WarsWarIdKillmailsGetItem::from($item),
            (array) $response->data,
        ));
    }
}
