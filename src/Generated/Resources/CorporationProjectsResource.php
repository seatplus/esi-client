<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiSchema\Responses\CorporationsProjectsContribution;
use Seatplus\EsiSchema\Responses\CorporationsProjectsContributors;
use Seatplus\EsiSchema\Responses\CorporationsProjectsDetail;
use Seatplus\EsiSchema\Responses\CorporationsProjectsListing;

/**
 * ESI tag: CorporationProjects
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class CorporationProjectsResource extends AbstractResource
{
    /**
     * @scope esi-corporations.read_projects.v1
     */
    public function getCorporationsProjectsListing(int $corporationId, ?string $after = null, ?string $before = null, ?int $limit = null, ?string $state = null): CorporationsProjectsListing
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/projects', ['corporation_id' => $corporationId], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit, 'state' => $state]);
        $dto = CorporationsProjectsListing::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-corporations.read_projects.v1
     */
    public function getCorporationsProjectsDetail(int $corporationId, string $projectId): CorporationsProjectsDetail
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/projects/{project_id}', ['corporation_id' => $corporationId, 'project_id' => $projectId], 'latest', []);
        $dto = CorporationsProjectsDetail::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-corporations.read_projects.v1
     */
    public function getCorporationsProjectsContribution(int $corporationId, string $projectId, int $characterId): CorporationsProjectsContribution
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/projects/{project_id}/contribution/{character_id}', ['corporation_id' => $corporationId, 'project_id' => $projectId, 'character_id' => $characterId], 'latest', []);
        $dto = CorporationsProjectsContribution::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-corporations.read_projects.v1
     */
    public function getCorporationsProjectsContributors(int $corporationId, string $projectId, ?string $after = null, ?string $before = null, ?int $limit = null): CorporationsProjectsContributors
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/projects/{project_id}/contributors', ['corporation_id' => $corporationId, 'project_id' => $projectId], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit]);
        $dto = CorporationsProjectsContributors::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }
}
