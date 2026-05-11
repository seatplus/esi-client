<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CharactersFreelanceJobsListing;
use Seatplus\EsiClient\Generated\Responses\CharactersFreelanceJobsParticipation;
use Seatplus\EsiClient\Generated\Responses\CorporationsFreelanceJobsListing;
use Seatplus\EsiClient\Generated\Responses\CorporationsFreelanceJobsParticipants;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsListing;
use Seatplus\EsiClient\Generated\Responses\FreelanceJobsDetail;

/**
 * ESI tag: FreelanceJobs
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class FreelanceJobsResource extends AbstractResource
{
    /**
     * @return EsiResult<CharactersFreelanceJobsListing>
     * @scope esi-characters.read_freelance_jobs.v1
     */
    public function getCharactersFreelanceJobsListing(int $characterId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/freelance-jobs', ['character_id' => $characterId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersFreelanceJobsListing::from($response->data));
    }

    /**
     * @return EsiResult<CharactersFreelanceJobsParticipation>
     * @scope esi-characters.read_freelance_jobs.v1
     */
    public function getCharactersFreelanceJobsParticipation(int $characterId, string $jobId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/freelance-jobs/{job_id}/participation', ['character_id' => $characterId, 'job_id' => $jobId], 'latest', []);
        return EsiResult::fromResponse($response, CharactersFreelanceJobsParticipation::from($response->data));
    }

    /**
     * @return EsiResult<CorporationsFreelanceJobsListing>
     * @scope esi-corporations.read_freelance_jobs.v1
     */
    public function getCorporationsFreelanceJobsListing(int $corporationId, ?string $after = null, ?string $before = null, ?int $limit = null): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/freelance-jobs', ['corporation_id' => $corporationId], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit]);
        return EsiResult::fromResponse($response, CorporationsFreelanceJobsListing::from($response->data));
    }

    /**
     * @return EsiResult<CorporationsFreelanceJobsParticipants>
     * @scope esi-corporations.read_freelance_jobs.v1
     */
    public function getCorporationsFreelanceJobsParticipants(int $corporationId, string $jobId, ?string $after = null, ?string $before = null, ?int $limit = null): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/freelance-jobs/{job_id}/participants', ['corporation_id' => $corporationId, 'job_id' => $jobId], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit]);
        return EsiResult::fromResponse($response, CorporationsFreelanceJobsParticipants::from($response->data));
    }

    /**
     * @return EsiResult<FreelanceJobsListing>
     */
    public function getFreelanceJobsListing(?string $after = null, ?string $before = null, ?int $limit = null, ?int $corporationId = null): EsiResult
    {
        $response = $this->client->invoke('get', '/freelance-jobs', [], 'latest', ['after' => $after, 'before' => $before, 'limit' => $limit, 'corporation_id' => $corporationId]);
        return EsiResult::fromResponse($response, FreelanceJobsListing::from($response->data));
    }

    /**
     * @return EsiResult<FreelanceJobsDetail>
     */
    public function getFreelanceJobsDetail(string $jobId): EsiResult
    {
        $response = $this->client->invoke('get', '/freelance-jobs/{job_id}', ['job_id' => $jobId], 'latest', []);
        return EsiResult::fromResponse($response, FreelanceJobsDetail::from($response->data));
    }
}