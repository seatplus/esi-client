<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;

/**
 * ESI tag: UserInterface
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class UserInterfaceResource extends AbstractResource
{
    /**
     * @return EsiResult<null>
     * @scope esi-ui.write_waypoint.v1
     */
    public function postUiAutopilotWaypoint(bool $addToBeginning, bool $clearOtherWaypoints, int $destinationId): EsiResult
    {
        $response = $this->client->invoke('post', '/ui/autopilot/waypoint', [], 'latest', ['add_to_beginning' => $addToBeginning, 'clear_other_waypoints' => $clearOtherWaypoints, 'destination_id' => $destinationId], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @scope esi-ui.open_window.v1
     */
    public function postUiOpenwindowContract(int $contractId): EsiResult
    {
        $response = $this->client->invoke('post', '/ui/openwindow/contract', [], 'latest', ['contract_id' => $contractId], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @scope esi-ui.open_window.v1
     */
    public function postUiOpenwindowInformation(int $targetId): EsiResult
    {
        $response = $this->client->invoke('post', '/ui/openwindow/information', [], 'latest', ['target_id' => $targetId], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @scope esi-ui.open_window.v1
     */
    public function postUiOpenwindowMarketdetails(int $typeId): EsiResult
    {
        $response = $this->client->invoke('post', '/ui/openwindow/marketdetails', [], 'latest', ['type_id' => $typeId], []);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<null>
     * @scope esi-ui.open_window.v1
     */
    public function postUiOpenwindowNewmail(mixed $requestBody): EsiResult
    {
        $response = $this->client->invoke('post', '/ui/openwindow/newmail', [], 'latest', [], (array) $requestBody);
        return EsiResult::fromResponse($response, null);
    }
}