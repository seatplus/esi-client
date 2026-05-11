<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsListing;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsDetail;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsContribution;
use Seatplus\EsiClient\Generated\Responses\CorporationsProjectsContributors;

/**
 * ESI tag: CorporationProjects
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class CorporationProjectsResource extends AbstractResource
{
    /**
     * @return EsiResult<CorporationsProjectsListing>
     * @scope esi-corporations.read_projects.v1
     */
    public function getCorporationsProjectsListing(int $corporationId, ?string $after = null, ?string $before = null, ?int $limit = null, ?string $state = null): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/projects', ['corporation_id' => $corporationId], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit, 'state' => $state]);
        return EsiResult::fromResponse($response, CorporationsProjectsListing::from($response->data));
    }

    /**
     * @return EsiResult<CorporationsProjectsDetail>
     * @scope esi-corporations.read_projects.v1
     */
    public function getCorporationsProjectsDetail(int $corporationId, string $projectId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/projects/{project_id}', ['corporation_id' => $corporationId, 'project_id' => $projectId], 'latest', []);
        return EsiResult::fromResponse($response, CorporationsProjectsDetail::from($response->data));
    }

    /**
     * @return EsiResult<CorporationsProjectsContribution>
     * @scope esi-corporations.read_projects.v1
     */
    public function getCorporationsProjectsContribution(int $corporationId, string $projectId, int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/projects/{project_id}/contribution/{character_id}', ['corporation_id' => $corporationId, 'project_id' => $projectId, 'character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CorporationsProjectsContribution::from($response->data));
    }

    /**
     * @return EsiResult<CorporationsProjectsContributors>
     * @scope esi-corporations.read_projects.v1
     */
    public function getCorporationsProjectsContributors(int $corporationId, string $projectId, ?string $after = null, ?string $before = null, ?int $limit = null): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/projects/{project_id}/contributors', ['corporation_id' => $corporationId, 'project_id' => $projectId], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit]);
        return EsiResult::fromResponse($response, CorporationsProjectsContributors::from($response->data));
    }
}