<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiSchema\Responses\CharactersFreelanceJobsListing;
use Seatplus\EsiSchema\Responses\CharactersFreelanceJobsParticipation;
use Seatplus\EsiSchema\Responses\CorporationsFreelanceJobsListing;
use Seatplus\EsiSchema\Responses\CorporationsFreelanceJobsParticipants;
use Seatplus\EsiSchema\Responses\FreelanceJobsDetail;
use Seatplus\EsiSchema\Responses\FreelanceJobsListing;

/**
 * ESI tag: FreelanceJobs
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class FreelanceJobsResource extends AbstractResource
{
    /**
     * @scope esi-characters.read_freelance_jobs.v1
     */
    public function getCharactersFreelanceJobsListing(int $characterId): CharactersFreelanceJobsListing
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/freelance-jobs', ['character_id' => $characterId], 'latest', []);
        $dto = CharactersFreelanceJobsListing::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-characters.read_freelance_jobs.v1
     */
    public function getCharactersFreelanceJobsParticipation(int $characterId, string $jobId): CharactersFreelanceJobsParticipation
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/freelance-jobs/{job_id}/participation', ['character_id' => $characterId, 'job_id' => $jobId], 'latest', []);
        $dto = CharactersFreelanceJobsParticipation::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-corporations.read_freelance_jobs.v1
     */
    public function getCorporationsFreelanceJobsListing(int $corporationId, ?string $after = null, ?string $before = null, ?int $limit = null): CorporationsFreelanceJobsListing
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/freelance-jobs', ['corporation_id' => $corporationId], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit]);
        $dto = CorporationsFreelanceJobsListing::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @scope esi-corporations.read_freelance_jobs.v1
     */
    public function getCorporationsFreelanceJobsParticipants(int $corporationId, string $jobId, ?string $after = null, ?string $before = null, ?int $limit = null): CorporationsFreelanceJobsParticipants
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/freelance-jobs/{job_id}/participants', ['corporation_id' => $corporationId, 'job_id' => $jobId], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit]);
        $dto = CorporationsFreelanceJobsParticipants::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    public function getFreelanceJobsListing(?string $after = null, ?string $before = null, ?int $limit = null, ?int $corporationId = null): FreelanceJobsListing
    {
        $response = $this->client->invoke('get', '/freelance-jobs', [], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit, 'corporation_id' => $corporationId]);
        $dto = FreelanceJobsListing::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    public function getFreelanceJobsDetail(string $jobId): FreelanceJobsDetail
    {
        $response = $this->client->invoke('get', '/freelance-jobs/{job_id}', ['job_id' => $jobId], 'latest', []);
        $dto = FreelanceJobsDetail::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }
}
