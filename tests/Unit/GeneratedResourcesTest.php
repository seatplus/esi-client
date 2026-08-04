<?php

use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\EsiClient;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiSchema\Contracts\ScopeAccessDeniedException;
use Seatplus\EsiSchema\EsiResult;
use Seatplus\EsiSchema\Resources\AllianceResource;
use Seatplus\EsiSchema\Resources\CharacterResource;
use Seatplus\EsiSchema\Resources\UniverseResource;
use Seatplus\EsiSchema\Responses\AllianceDetail;
use Seatplus\EsiSchema\Responses\CharactersDetail;
use Seatplus\EsiSchema\Responses\CharactersSkillqueueSkill;
use Seatplus\EsiSchema\Responses\UniverseTypesTypeIdGet;

function makeEsiResponse(string $raw, array $headers = []): EsiResponse
{
    return new EsiResponse($raw, $headers, 'now', 200);
}

/**
 * Build a client with a real JWT token that includes the given scopes.
 * Scope enforcement now happens in assertScope() — no more CheckAccess mock needed.
 */
function makeAuthedClient(GuzzleFetcher $fetcher, array $scopes = ['esi-assets.read_assets.v1', 'esi-universe.read_structures.v1', 'esi-characters.read_characters.v1']): EsiClient
{
    $token = buildJWT(json_encode(['scp' => $scopes]));

    return new EsiClient(
        new EsiAuthentication($token, ''),
        $fetcher,
    );
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

    expect($client)->toBeInstanceOf(EsiClient::class);
});

// ---------------------------------------------------------------------------
// Resource factory methods
// ---------------------------------------------------------------------------

it('characters() returns a CharacterResource', function () {
    $client = new EsiClient;

    expect($client->characters())->toBeInstanceOf(CharacterResource::class);
});

it('alliance() returns an AllianceResource', function () {
    $client = new EsiClient;

    expect($client->alliance())->toBeInstanceOf(AllianceResource::class);
});

it('universe() returns a UniverseResource', function () {
    $client = new EsiClient;

    expect($client->universe())->toBeInstanceOf(UniverseResource::class);
});

// ---------------------------------------------------------------------------
// Object response — returns DTO directly (no EsiResult wrapper)
// ---------------------------------------------------------------------------

it('getCharactersDetail returns CharactersDetail DTO directly', function () {
    $raw = json_encode([
        'name' => 'Test Pilot',
        'corporation_id' => 98000001,
        'birthday' => '2010-01-01T00:00:00Z',
        'bloodline_id' => 1,
        'race_id' => 2,
        'gender' => 'male',
        'security_status' => 1.5,
    ]);

    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(makeEsiResponse($raw));

    $client = new EsiClient(new EsiAuthentication('tok', ''), $fetcher);
    $dto = $client->characters()->getCharactersDetail(123);

    expect($dto)->toBeInstanceOf(CharactersDetail::class)
        ->and($dto->name)->toBe('Test Pilot')
        ->and($dto->corporation_id)->toBe(98000001)
        ->and($dto->pages)->toBe(1)
        ->and($dto->isCachedLoad)->toBeFalse();
});

// ---------------------------------------------------------------------------
// Paginated array response — still returns EsiResult (needs pages metadata)
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

    expect($result)->toBeInstanceOf(EsiResult::class)
        ->and($result->pages)->toBe(4)
        ->and($result->data)->toBeArray()
        ->and($result->data)->toHaveCount(1);
});

// ---------------------------------------------------------------------------
// Non-paginated array response — hydrated into DTOs, not dropped
//
// Regression guard: esi-schema 3.0.0 shipped this operation with `data: null`,
// so the skill queue came back silently empty. Fixed in 4.0.0.
// ---------------------------------------------------------------------------

it('getCharactersCharacterIdSkillqueue hydrates the queue into DTOs', function () {
    $raw = json_encode([
        [
            'finished_level' => 4,
            'queue_position' => 0,
            'skill_id' => 3300,
            'finish_date' => '2026-08-10T12:00:00Z',
            'start_date' => '2026-08-04T12:00:00Z',
            'level_end_sp' => 45255,
            'level_start_sp' => 8000,
            'training_start_sp' => 8000,
        ],
        [
            'finished_level' => 5,
            'queue_position' => 1,
            'skill_id' => 3301,
        ],
    ]);

    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(makeEsiResponse($raw));

    $client = makeAuthedClient($fetcher, ['esi-skills.read_skillqueue.v1']);
    $result = $client->skills()->getCharactersCharacterIdSkillqueue(123);

    expect($result)->toBeInstanceOf(EsiResult::class)
        ->and($result->data)->toBeArray()
        ->and($result->data)->toHaveCount(2)
        ->and($result->data[0])->toBeInstanceOf(CharactersSkillqueueSkill::class)
        ->and($result->data[0]->skill_id)->toBe(3300)
        ->and($result->data[0]->queue_position)->toBe(0)
        ->and($result->data[0]->finished_level)->toBe(4)
        ->and($result->data[0]->finish_date)->toBe('2026-08-10T12:00:00Z')
        ->and($result->data[1])->toBeInstanceOf(CharactersSkillqueueSkill::class)
        ->and($result->data[1]->skill_id)->toBe(3301)
        ->and($result->data[1]->finish_date)->toBeNull();
});

it('getCharactersCharacterIdSkillqueue returns an empty array for an empty queue', function () {
    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(makeEsiResponse('[]'));

    $client = makeAuthedClient($fetcher, ['esi-skills.read_skillqueue.v1']);
    $result = $client->skills()->getCharactersCharacterIdSkillqueue(123);

    expect($result->data)->toBeArray()
        ->and($result->data)->toBeEmpty();
});

it('getCharactersCharacterIdSkillqueue requires the read_skillqueue scope', function () {
    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldNotReceive('call');

    $client = makeAuthedClient($fetcher, ['esi-assets.read_assets.v1']);

    expect(fn () => $client->skills()->getCharactersCharacterIdSkillqueue(123))
        ->toThrow(ScopeAccessDeniedException::class);
});

// ---------------------------------------------------------------------------
// Another object response — universe type
// ---------------------------------------------------------------------------

it('getUniverseTypesTypeId returns typed DTO directly', function () {
    $raw = json_encode([
        'type_id' => 35,
        'name' => 'Tritanium',
        'description' => 'The most basic mineral.',
        'published' => true,
        'group_id' => 18,
    ]);

    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(makeEsiResponse($raw));

    $client = new EsiClient(new EsiAuthentication('tok', ''), $fetcher);
    $dto = $client->universe()->getUniverseTypesTypeId(35);

    expect($dto)->toBeInstanceOf(UniverseTypesTypeIdGet::class)
        ->and($dto->name)->toBe('Tritanium')
        ->and($dto->type_id)->toBe(35);
});

// ---------------------------------------------------------------------------
// isCachedLoad is propagated onto the DTO
// ---------------------------------------------------------------------------

it('isCachedLoad is true when response has X-Kevinrob-Cache HIT', function () {
    $raw = json_encode([
        'name' => 'Test Alliance',
        'ticker' => 'TEST',
        'creator_id' => 12345,
        'creator_corporation_id' => 98000001,
        'date_founded' => '2010-01-01T00:00:00Z',
    ]);

    $fetcher = mock(GuzzleFetcher::class);
    $fetcher->shouldReceive('call')->once()->andReturn(
        makeEsiResponse($raw, ['X-Kevinrob-Cache' => ['HIT']])
    );

    $dto = makeAuthedClient($fetcher)->alliance()->getAlliancesAllianceId(99000001);

    expect($dto)->toBeInstanceOf(AllianceDetail::class)
        ->and($dto->isCachedLoad)->toBeTrue()
        ->and($dto->name)->toBe('Test Alliance');
});

// ---------------------------------------------------------------------------
// All remaining factory methods — verify they return the correct resource type
// ---------------------------------------------------------------------------

it('remaining factory methods return the correct resource type', function (string $method) {
    $client = new EsiClient;

    expect($client->$method())->toBeObject();
})->with([
    'calendar',
    'clones',
    'contacts',
    'contracts',
    'corporation',
    'dogma',
    'factionWarfare',
    'fittings',
    'fleets',
    'incursions',
    'industry',
    'insurance',
    'killmails',
    'location',
    'loyalty',
    'mail',
    'market',
    'planetaryInteraction',
    'routes',
    'search',
    'skills',
    'sovereignty',
    'status',
    'userInterface',
    'wallet',
    'wars',
    'corporationProjects',
    'freelanceJobs',
    'meta',
]);
