<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdCalendarEventIdAttendeesGetItem;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdCalendarEventIdGet;
use Seatplus\EsiSchema\Responses\CharactersCharacterIdCalendarGetItem;

/**
 * ESI tag: Calendar
 *
 * Generated from ESI OpenAPI spec (compatibility date: 2025-12-16).
 * Do not edit manually — run bin/generate.php instead.
 */
class CalendarResource extends AbstractResource
{
    /**
     * @return EsiResult<array<CharactersCharacterIdCalendarGetItem>>
     *
     * @scope esi-calendar.read_calendar_events.v1
     */
    public function getCharactersCharacterIdCalendar(int $characterId, ?int $fromEvent = null): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/calendar', ['character_id' => $characterId], 'latest', ['from_event' => $fromEvent]);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdCalendarGetItem::from($item),
            (array) $response->data,
        ));
    }

    /**
     * @scope esi-calendar.read_calendar_events.v1
     */
    public function getCharactersCharacterIdCalendarEventId(int $characterId, int $eventId): CharactersCharacterIdCalendarEventIdGet
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/calendar/{event_id}', ['character_id' => $characterId, 'event_id' => $eventId], 'latest', []);
        $dto = CharactersCharacterIdCalendarEventIdGet::from($response->data);
        $dto->isCachedLoad = $response->isCachedLoad();
        $dto->pages = $response->pages ?? 1;

        return $dto;
    }

    /**
     * @return EsiResult<null>
     *
     * @scope esi-calendar.respond_calendar_events.v1
     */
    public function putCharactersCharacterIdCalendarEventId(mixed $requestBody, int $characterId, int $eventId): EsiResult
    {
        $response = $this->client->invoke('put', '/characters/{character_id}/calendar/{event_id}', ['character_id' => $characterId, 'event_id' => $eventId], 'latest', [], (array) $requestBody);

        return EsiResult::fromResponse($response, null);
    }

    /**
     * @return EsiResult<array<CharactersCharacterIdCalendarEventIdAttendeesGetItem>>
     *
     * @scope esi-calendar.read_calendar_events.v1
     */
    public function getCharactersCharacterIdCalendarEventIdAttendees(int $characterId, int $eventId): EsiResult
    {
        $response = $this->client->invoke('get', '/characters/{character_id}/calendar/{event_id}/attendees', ['character_id' => $characterId, 'event_id' => $eventId], 'latest', []);

        return EsiResult::fromResponse($response, array_map(
            fn (object $item) => CharactersCharacterIdCalendarEventIdAttendeesGetItem::from($item),
            (array) $response->data,
        ));
    }
}
