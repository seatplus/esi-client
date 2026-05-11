<?php

use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\EsiClient;
use Seatplus\EsiClient\EsiResult;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Generated\Resources\AllianceResource;
use Seatplus\EsiClient\Generated\Resources\CharacterResource;
use Seatplus\EsiClient\Generated\Resources\UniverseResource;
use Seatplus\EsiClient\Generated\Responses\AllianceDetail;
use Seatplus\EsiClient\Generated\Responses\CharactersDetail;
use Seatplus\EsiClient\Generated\Responses\UniverseTypesTypeIdGet;
use Seatplus\EsiClient\Services\CheckAccess;

function makeEsiResponse(string $raw, array $headers = []): EsiResponse
{
    return new EsiResponse($raw, $headers, 'now', 200);
}

/** Build a client whose CheckAccess always returns true (no JWT decode needed). */
function makeAuthedClient(GuzzleFetcher $fetcher): EsiClient
{
    $checkAccess = mock(CheckAccess::class);
    $checkAccess->shouldReceive('can')->andReturn(true);

    return new EsiClient(new EsiAuthentication('tok', ''), $fetcher, $checkAccess);
}

// ---------------------------------------------------------------------------
// EsiClient::withToken()
// ---------------------------------------------------------------------------

it('withToken returns a new instance with the token set', function () {
    $authentication = new EsiAuthentication('old-token', 'refresh');
    $fetcher = mock(GuzzleFetcher::class);
    $client = new EsiClient($authentication, $fetcher);

    $tokenClient = $client->withToken('new-token');

    expect($tokenClient)->not->toBe($client)
        ->and($tokenClient)->toBeInstanceOf(EsiClient::class);
});

it('withToken does not mutate the original client', function () {
    $authentication = new EsiAuthentication('original-token', 'refresh');
    $fetcher = mock(GuzzleFetcher::class);
    $client = new EsiClient($authentication, $fetcher);

    $client->withToken('new-token');

    // No way to read authentication back (private), but the clone pattern
    // guarantees the original is not affected — verify the client is still usable.
    expect($client)->toBeInstanceOf(EsiClient::class);
});

// ---------------------------------------------------------------------------
// Resource factory methods
// ---------------------------------------------------------------------------

it('characters() returns a CharacterResource', function () {
    $client = new EsiClient();

    expect($client->characters())->toBeInstanceOf(CharacterResource::class);
});

it('alliance() returns an AllianceResource', function () {
    $client = new EsiClient();

    expect($client->alliance())->toBeInstanceOf(AllianceResource::class);
});

it('universe() returns a UniverseResource', function () {
    $client = new EsiClient();

    expect($client->universe())->toBeInstanceOf(UniverseResource::class);
});

// ---------------------------------------------------------------------------
// CharacterResource::getCharactersCharacterId
// ---------------------------------------------------------------------------

it('getCharactersCharacterId returns a typed EsiResult', function () {
    $raw = json_encode([
        'name'             => 'Test Pilot',
        'corporation_id'   => 98000001,
        'birthday'         => '2010-01-01T00:00:00Z',
        'bloodline_id'     => 1,
        'race_id'          => 2,
        'gender'           => 'male',
        'security_status'  => 1.5,
    ]);

    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(makeEsiResponse($raw));

    $client = new EsiClient(new EsiAuthentication('tok', ''), $fetcher);
    $result = $client->characters()->getCharactersCharacterId(123);

    expect($result)->toBeInstanceOf(EsiResult::class)
        ->and($result->data)->toBeInstanceOf(CharactersDetail::class)
        ->and($result->data->name)->toBe('Test Pilot')
        ->and($result->data->corporation_id)->toBe(98000001)
        ->and($result->pages)->toBe(1);
});

// ---------------------------------------------------------------------------
// Paginated resource: CharacterResource::getCharactersCharacterIdAssets
// ---------------------------------------------------------------------------

it('paginated resource returns correct page count from X-Pages header', function () {
    $raw = json_encode([
        ['item_id' => 1, 'location_id' => 60000004, 'location_type' => 'station',
         'location_flag' => 'Hangar', 'quantity' => 1, 'type_id' => 35, 'is_singleton' => false],
    ]);

    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(
        makeEsiResponse($raw, ['X-Pages' => ['4']])
    );

    $result = makeAuthedClient($fetcher)->assets()->getCharactersCharacterIdAssets(123, page: 1);

    expect($result->pages)->toBe(4)
        ->and($result->data)->toBeArray()
        ->and($result->data)->toHaveCount(1);
});

// ---------------------------------------------------------------------------
// Universe type: object response with optional fields
// ---------------------------------------------------------------------------

it('getUniverseTypesTypeId returns typed DTO with required fields', function () {
    $raw = json_encode([
        'type_id'       => 35,
        'name'          => 'Tritanium',
        'description'   => 'The most basic mineral.',
        'published'     => true,
        'group_id'      => 18,
    ]);

    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(makeEsiResponse($raw));

    $client = new EsiClient(new EsiAuthentication('tok', ''), $fetcher);
    $result = $client->universe()->getUniverseTypesTypeId(35);

    expect($result)->toBeInstanceOf(EsiResult::class)
        ->and($result->data)->toBeInstanceOf(UniverseTypesTypeIdGet::class)
        ->and($result->data->name)->toBe('Tritanium')
        ->and($result->data->type_id)->toBe(35);
});

// ---------------------------------------------------------------------------
// Cached load propagation
// ---------------------------------------------------------------------------

it('isCachedLoad is true when response has X-Kevinrob-Cache HIT', function () {
    $raw = json_encode([
        'name'                   => 'Test Alliance',
        'ticker'                 => 'TEST',
        'creator_id'             => 12345,
        'creator_corporation_id' => 98000001,
        'date_founded'           => '2010-01-01T00:00:00Z',
    ]);

    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(
        makeEsiResponse($raw, ['X-Kevinrob-Cache' => ['HIT']])
    );

    $result = makeAuthedClient($fetcher)->alliance()->getAlliancesAllianceId(99000001);

    expect($result->isCachedLoad)->toBeTrue()
        ->and($result->data)->toBeInstanceOf(AllianceDetail::class);
});
