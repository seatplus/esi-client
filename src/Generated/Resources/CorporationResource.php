<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\CorporationsDetail;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdAlliancehistoryGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdBlueprintsGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdContainersLogsGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdDivisionsGet;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdFacilitiesGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdIconsGet;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdMedalsGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdMedalsIssuedGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdMembersTitlesGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdMembertrackingGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdRolesGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdRolesHistoryGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdShareholdersGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdStandingsGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdStarbasesGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdStarbasesStarbaseIdGet;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdStructuresGetItem;
use Seatplus\EsiClient\Generated\Responses\CorporationsCorporationIdTitlesGetItem;

/**
 * ESI tag: Corporation
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class CorporationResource extends AbstractResource
{
    /**
     * @return EsiResult<array<int>>
     */
    public function getCorporationsNpccorps(): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/npccorps', [], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<CorporationsDetail>
     */
    public function getCorporationsCorporationId(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, CorporationsDetail::from($response->data));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdAlliancehistoryGetItem>>
     */
    public function getCorporationsCorporationIdAlliancehistory(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/alliancehistory', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdAlliancehistoryGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdBlueprintsGetItem>>
     * @scope esi-corporations.read_blueprints.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdBlueprints(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/blueprints', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdBlueprintsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdContainersLogsGetItem>>
     * @scope esi-corporations.read_container_logs.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdContainersLogs(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/containers/logs', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdContainersLogsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<CorporationsCorporationIdDivisionsGet>
     * @scope esi-corporations.read_divisions.v1
     */
    public function getCorporationsCorporationIdDivisions(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/divisions', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, CorporationsCorporationIdDivisionsGet::from($response->data));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdFacilitiesGetItem>>
     * @scope esi-corporations.read_facilities.v1
     */
    public function getCorporationsCorporationIdFacilities(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/facilities', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdFacilitiesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<CorporationsCorporationIdIconsGet>
     */
    public function getCorporationsCorporationIdIcons(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/icons', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, CorporationsCorporationIdIconsGet::from($response->data));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdMedalsGetItem>>
     * @scope esi-corporations.read_medals.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdMedals(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/medals', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdMedalsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdMedalsIssuedGetItem>>
     * @scope esi-corporations.read_medals.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdMedalsIssued(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/medals/issued', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdMedalsIssuedGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<int>>
     * @scope esi-corporations.read_corporation_membership.v1
     */
    public function getCorporationsCorporationIdMembers(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/members', ['corporation_id' => $corporationId], 'latest', []);
        /** @var array<int> $data */
        $data = array_map(fn(mixed $i) => (int) $i, (array) $response->data);
        return EsiResult::fromResponse($response, $data);
    }

    /**
     * @return EsiResult<int>
     * @scope esi-corporations.track_members.v1
     */
    public function getCorporationsCorporationIdMembersLimit(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/members/limit', ['corporation_id' => $corporationId], 'latest', []);
        /** @var int $scalar */
        $scalar = json_decode($response->raw);
        return EsiResult::fromResponse($response, $scalar);
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdMembersTitlesGetItem>>
     * @scope esi-corporations.read_titles.v1
     */
    public function getCorporationsCorporationIdMembersTitles(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/members/titles', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdMembersTitlesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdMembertrackingGetItem>>
     * @scope esi-corporations.track_members.v1
     */
    public function getCorporationsCorporationIdMembertracking(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/membertracking', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdMembertrackingGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdRolesGetItem>>
     * @scope esi-corporations.read_corporation_membership.v1
     */
    public function getCorporationsCorporationIdRoles(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/roles', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdRolesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdRolesHistoryGetItem>>
     * @scope esi-corporations.read_corporation_membership.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdRolesHistory(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/roles/history', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdRolesHistoryGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdShareholdersGetItem>>
     * @scope esi-wallet.read_corporation_wallets.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdShareholders(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/shareholders', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdShareholdersGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdStandingsGetItem>>
     * @scope esi-corporations.read_standings.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdStandings(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/standings', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdStandingsGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdStarbasesGetItem>>
     * @scope esi-corporations.read_starbases.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdStarbases(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/starbases', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdStarbasesGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<CorporationsCorporationIdStarbasesStarbaseIdGet>
     * @scope esi-corporations.read_starbases.v1
     */
    public function getCorporationsCorporationIdStarbasesStarbaseId(int $corporationId, int $starbaseId, int $systemId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/starbases/{starbase_id}', ['corporation_id' => $corporationId, 'starbase_id' => $starbaseId], 'latest', ['system_id' => $systemId]);
        return EsiResult::fromResponse($response, CorporationsCorporationIdStarbasesStarbaseIdGet::from($response->data));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdStructuresGetItem>>
     * @scope esi-corporations.read_structures.v1
     * @paginated Use $page param to iterate pages.
     */
    public function getCorporationsCorporationIdStructures(int $corporationId, int $page = 1): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/structures', ['corporation_id' => $corporationId], 'latest', ['page' => $page]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdStructuresGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<array<CorporationsCorporationIdTitlesGetItem>>
     * @scope esi-corporations.read_titles.v1
     */
    public function getCorporationsCorporationIdTitles(int $corporationId): EsiResult
    {
        $response = $this->client->invoke('get', '/corporations/{corporation_id}/titles', ['corporation_id' => $corporationId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => CorporationsCorporationIdTitlesGetItem::from($item),
            (array) $response->data,
        ));
    }
}