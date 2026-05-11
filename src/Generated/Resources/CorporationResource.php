<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdAlliancehistoryItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdBlueprintsItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdContainersLogsItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdDivisionsResponse;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdFacilitiesItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdIconsResponse;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdMedalsIssuedItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdMedalsItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdMembersTitlesItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdMembertrackingItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdResponse;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdRolesHistoryItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdRolesItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdShareholdersItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdStandingsItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdStarbasesItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdStarbasesStarbaseIdResponse;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdStructuresItem;
use Seatplus\EsiClient\Generated\Responses\Corporation\GetCorporationsCorporationIdTitlesItem;

/**
 * ESI tag: Corporation
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class CorporationResource extends AbstractResource
{
    /**
     * @return EsiResult<array<int>>
     */
    public function getCorporationsNpccorps(): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/npccorps/', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<GetCorporationsCorporationIdResponse>
     */
    public function getCorporationsCorporationId(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, GetCorporationsCorporationIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdAlliancehistoryItem>>
     */
    public function getCorporationsCorporationIdAlliancehistory(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/alliancehistory/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdAlliancehistoryItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdBlueprintsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdBlueprints(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/blueprints/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdBlueprintsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdContainersLogsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdContainersLogs(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/containers/logs/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdContainersLogsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCorporationsCorporationIdDivisionsResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdDivisions(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/divisions/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, GetCorporationsCorporationIdDivisionsResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdFacilitiesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdFacilities(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/facilities/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdFacilitiesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCorporationsCorporationIdIconsResponse>
     */
    public function getCorporationsCorporationIdIcons(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/icons/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, GetCorporationsCorporationIdIconsResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdMedalsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdMedals(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/medals/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdMedalsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdMedalsIssuedItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdMedalsIssued(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/medals/issued/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdMedalsIssuedItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdMembers(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/members/', ['corporation_id' => $corporationId], 'latest', []);
        /** @var array<int> $data */
        $data = array_values((array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<int>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdMembersLimit(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/members/limit/', ['corporation_id' => $corporationId], 'latest', []);
        /** @var int $scalar */
        $scalar = json_decode($response->raw);
        return EsiResult::fromResponse($response, $scalar);
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdMembersTitlesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdMembersTitles(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/members/titles/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdMembersTitlesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdMembertrackingItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdMembertracking(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/membertracking/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdMembertrackingItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdRolesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdRoles(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/roles/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdRolesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdRolesHistoryItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdRolesHistory(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/roles/history/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdRolesHistoryItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdShareholdersItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdShareholders(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/shareholders/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdShareholdersItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdStandingsItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdStandings(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/standings/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdStandingsItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdStarbasesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdStarbases(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/starbases/', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdStarbasesItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCorporationsCorporationIdStarbasesStarbaseIdResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdStarbasesStarbaseId(int $corporationId, int $starbaseId, int $systemId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/starbases/{starbase_id}/', ['corporation_id' => $corporationId, 'starbase_id' => $starbaseId], 'latest', ['system_id' => $systemId]);
        return EsiResult::fromResponse($response, GetCorporationsCorporationIdStarbasesStarbaseIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdStructuresItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     * @paginated    Use $page parameter to iterate pages.
     */
    public function getCorporationsCorporationIdStructures(int $corporationId, ?string $language = null, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/structures/', ['corporation_id' => $corporationId], 'latest', ['language' => $language, 'page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdStructuresItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<GetCorporationsCorporationIdTitlesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCorporationsCorporationIdTitles(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/titles/', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCorporationsCorporationIdTitlesItem::from($item),
            (array) $response->data,
        ));
    }
}