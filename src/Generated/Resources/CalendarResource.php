<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Generated\Responses\Calendar\GetCharactersCharacterIdCalendarEventIdAttendeesItem;
use Seatplus\EsiClient\Generated\Responses\Calendar\GetCharactersCharacterIdCalendarEventIdResponse;
use Seatplus\EsiClient\Generated\Responses\Calendar\GetCharactersCharacterIdCalendarItem;

/**
 * ESI tag: Calendar
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-10-01).
 * Do not edit manually — run bin/generate.php instead.
 */
class CalendarResource extends AbstractResource
{
    /**
     * @return EsiResult<array<GetCharactersCharacterIdCalendarItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdCalendar(int $characterId, ?int $fromEvent = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/calendar/', ['character_id' => $characterId], 'latest', ['from_event' => $fromEvent]);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdCalendarItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @return EsiResult<GetCharactersCharacterIdCalendarEventIdResponse>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdCalendarEventId(int $characterId, int $eventId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/calendar/{event_id}/', ['character_id' => $characterId, 'event_id' => $eventId], 'latest', []);
        return EsiResult::fromResponse($response, GetCharactersCharacterIdCalendarEventIdResponse::from($response->data));
    }

    /**
     * @return EsiResult<null>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function putCharactersCharacterIdCalendarEventId(int $characterId, int $eventId, mixed $response): EsiResult
    {
        $response = $this->client->invoke('put', '/characters/{character_id}/calendar/{event_id}/', ['character_id' => $characterId, 'event_id' => $eventId], 'latest', [], (array) $response);
        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<GetCharactersCharacterIdCalendarEventIdAttendeesItem>>
     * @requires-auth Use ->withToken($accessToken) on the client.
     */
    public function getCharactersCharacterIdCalendarEventIdAttendees(int $characterId, int $eventId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/calendar/{event_id}/attendees/', ['character_id' => $characterId, 'event_id' => $eventId], 'latest', []);
        return EsiResult::fromResponse($response, array_map(
            fn(object $item) => GetCharactersCharacterIdCalendarEventIdAttendeesItem::from($item),
            (array) $response->data,
        ));
    }
}