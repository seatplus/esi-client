<?php

use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Seatplus\EsiClient\EsiResult;

function makeResponse(string $raw, array $headers = [], int $code = 200): EsiResponse
{
    return new EsiResponse($raw, $headers, 'now', $code);
}

it('creates EsiResult with defaults', function () {
    $result = new EsiResult(data: 'hello');

    expect($result->data)->toBe('hello')
        ->and($result->pages)->toBe(1)
        ->and($result->isCachedLoad)->toBeFalse();
});

it('creates EsiResult with explicit pages and cached flag', function () {
    $result = new EsiResult(data: [], pages: 5, isCachedLoad: true);

    expect($result->pages)->toBe(5)
        ->and($result->isCachedLoad)->toBeTrue();
});

it('builds EsiResult from EsiResponse with object body', function () {
    $response = makeResponse('{"name":"Pilot","corporation_id":123}');
    $dto = (object) ['name' => 'Pilot', 'corporation_id' => 123];

    $result = EsiResult::fromResponse($response, $dto);

    expect($result->data)->toBe($dto)
        ->and($result->pages)->toBe(1)
        ->and($result->isCachedLoad)->toBeFalse();
});

it('extracts pages from X-Pages header', function () {
    $response = makeResponse('[]', ['X-Pages' => ['3']]);

    $result = EsiResult::fromResponse($response, []);

    expect($result->pages)->toBe(3);
});

it('reports cached load from X-Kevinrob-Cache HIT header', function () {
    $response = makeResponse('{}', ['X-Kevinrob-Cache' => ['HIT']]);

    $result = EsiResult::fromResponse($response, new stdClass);

    expect($result->isCachedLoad)->toBeTrue();
});

it('reports non-cached load when cache header is MISS', function () {
    $response = makeResponse('{}', ['X-Kevinrob-Cache' => ['MISS']]);

    $result = EsiResult::fromResponse($response, new stdClass);

    expect($result->isCachedLoad)->toBeFalse();
});
