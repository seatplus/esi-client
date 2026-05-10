<?php

use Seatplus\EsiClient\DataTransferObjects\EsiResponse;

it('parses headers correctly', function () {
    $raw_headers = [
        'X-Esi-Error-Limit-Remain' => ['100'],
        'X-Pages' => ['5'],
        'X-Kevinrob-Cache' => ['HIT'],
        123,
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->parsed_headers['X-Esi-Error-Limit-Remain'])->toBe('100')
        ->and($response->parsed_headers['X-Pages'])->toBe('5')
        ->and($response->parsed_headers['X-Kevinrob-Cache'])->toBe('HIT');
});

it('detects cache load correctly', function () {
    $raw_headers = [
        'X-Kevinrob-Cache' => ['HIT'],
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->isCachedLoad())->toBeTrue();
});

it('handles missing cache header', function () {
    $raw_headers = [];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->isCachedLoad())->toBeFalse();
});

it('parses error message correctly', function () {
    $raw = json_encode(['error' => 'Some error', 'error_description' => 'Detailed description']);
    $response = new EsiResponse($raw, [], 'now', 200);

    expect($response->getErrorMessage())->toBe('Some error: Detailed description');
});

it('handles missing error message', function () {
    $raw = json_encode([]);
    $response = new EsiResponse($raw, [], 'now', 200);

    expect($response->getErrorMessage())->toBe('');
});

it('parses error limit remain correctly', function () {
    $raw_headers = [
        'X-Esi-Error-Limit-Remain' => ['100'],
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->error_limit_remain)->toBe(100);
});

it('parses pages correctly', function () {
    $raw_headers = [
        'X-Pages' => ['5'],
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->pages)->toBe(5);
});

it('returns null when header is not found', function () {
    $raw_headers = [
        'X-Esi-Error-Limit-Remain' => ['100'],
        'X-Pages' => ['5'],
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    $reflection = new ReflectionClass($response);
    $method = $reflection->getMethod('getHeader');

    $result = $method->invokeArgs($response, [$raw_headers, 'Non-Existent-Header']);

    expect($result)->toBeNull();
});

it('parses rate limit headers correctly', function () {
    $raw_headers = [
        'X-Ratelimit-Group' => ['char-asset'],
        'X-Ratelimit-Limit' => ['1800/15m'],
        'X-Ratelimit-Remaining' => ['1750'],
        'X-Ratelimit-Used' => ['50'],
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->ratelimitGroup)->toBe('char-asset')
        ->and($response->ratelimitLimit)->toBe(1800)
        ->and($response->ratelimitRemaining)->toBe(1750)
        ->and($response->ratelimitUsed)->toBe(50);
});

it('parses rate limit limit without window suffix', function () {
    $response = new EsiResponse('{}', ['X-Ratelimit-Limit' => ['300']], 'now', 200);

    expect($response->ratelimitLimit)->toBe(300);
});

it('parses Retry-After header', function () {
    $response = new EsiResponse('{}', ['Retry-After' => ['45']], 'now', 429);

    expect($response->retryAfter)->toBe(45);
});

it('returns null for missing rate limit headers', function () {
    $response = new EsiResponse('{}', [], 'now', 200);

    expect($response->ratelimitGroup)->toBeNull()
        ->and($response->ratelimitLimit)->toBeNull()
        ->and($response->ratelimitRemaining)->toBeNull()
        ->and($response->ratelimitUsed)->toBeNull()
        ->and($response->retryAfter)->toBeNull();
});

it('isRateLimitLow returns false when headers absent', function () {
    $response = new EsiResponse('{}', [], 'now', 200);

    expect($response->isRateLimitLow())->toBeFalse();
});

it('isRateLimitLow returns false when remaining is above 10 percent', function () {
    $response = new EsiResponse('{}', [
        'X-Ratelimit-Limit' => ['1800/15m'],
        'X-Ratelimit-Remaining' => ['200'],
    ], 'now', 200);

    expect($response->isRateLimitLow())->toBeFalse();
});

it('isRateLimitLow returns true when remaining is below 10 percent', function () {
    $response = new EsiResponse('{}', [
        'X-Ratelimit-Limit' => ['1800/15m'],
        'X-Ratelimit-Remaining' => ['100'],
    ], 'now', 200);

    expect($response->isRateLimitLow())->toBeTrue();
});

it('deprecated __get bridge still delegates to data object', function () {
    $raw = json_encode(['name' => 'Test Character', 'race_id' => 1]);
    $response = new EsiResponse($raw, [], 'now', 200);

    expect($response->name)->toBe('Test Character')
        ->and($response->race_id)->toBe(1)
        ->and($response->nonExistent)->toBeNull();
});

it('deprecated __isset bridge checks data object properties', function () {
    $raw = json_encode(['name' => 'Test Character']);
    $response = new EsiResponse($raw, [], 'now', 200);

    expect(isset($response->name))->toBeTrue()
        ->and(isset($response->missing))->toBeFalse();
});

it('data property holds the decoded json body', function () {
    $raw = json_encode(['ticker' => 'TEST', 'member_count' => 100]);
    $response = new EsiResponse($raw, [], 'now', 200);

    expect($response->data->ticker)->toBe('TEST')
        ->and($response->data->member_count)->toBe(100);
});
