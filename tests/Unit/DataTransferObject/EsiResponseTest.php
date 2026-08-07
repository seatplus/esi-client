<?php

use Seatplus\EsiClient\DataTransferObjects\EsiResponse;

it('parses headers correctly', function () {
    $rawHeaders = [
        'X-Esi-Error-Limit-Remain' => ['100'],
        'X-Pages' => ['5'],
        'X-Kevinrob-Cache' => ['HIT'],
        123,
    ];
    $response = new EsiResponse('{}', $rawHeaders, 'now', 200);

    expect($response->parsedHeaders['X-Esi-Error-Limit-Remain'])->toBe('100')
        ->and($response->parsedHeaders['X-Pages'])->toBe('5')
        ->and($response->parsedHeaders['X-Kevinrob-Cache'])->toBe('HIT');
});

it('detects cache load correctly', function () {
    $rawHeaders = [
        'X-Kevinrob-Cache' => ['HIT'],
    ];
    $response = new EsiResponse('{}', $rawHeaders, 'now', 200);

    expect($response->isCachedLoad())->toBeTrue();
});

it('handles missing cache header', function () {
    $rawHeaders = [];
    $response = new EsiResponse('{}', $rawHeaders, 'now', 200);

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
    $rawHeaders = [
        'X-Esi-Error-Limit-Remain' => ['100'],
    ];
    $response = new EsiResponse('{}', $rawHeaders, 'now', 200);

    expect($response->errorLimitRemain)->toBe(100);
});

it('parses pages correctly', function () {
    $rawHeaders = [
        'X-Pages' => ['5'],
    ];
    $response = new EsiResponse('{}', $rawHeaders, 'now', 200);

    expect($response->pages)->toBe(5);
});

it('returns null when header is not found', function () {
    $rawHeaders = [
        'X-Esi-Error-Limit-Remain' => ['100'],
        'X-Pages' => ['5'],
    ];
    $response = new EsiResponse('{}', $rawHeaders, 'now', 200);

    $reflection = new ReflectionClass($response);
    $method = $reflection->getMethod('getHeader');

    $result = $method->invokeArgs($response, [$rawHeaders, 'Non-Existent-Header']);

    expect($result)->toBeNull();
});

it('parses rate limit headers correctly', function () {
    $rawHeaders = [
        'X-Ratelimit-Group' => ['char-asset'],
        'X-Ratelimit-Limit' => ['1800/15m'],
        'X-Ratelimit-Remaining' => ['1750'],
        'X-Ratelimit-Used' => ['50'],
    ];
    $response = new EsiResponse('{}', $rawHeaders, 'now', 200);

    expect($response->ratelimitGroup)->toBe('char-asset')
        ->and($response->ratelimitLimit)->toBe(1800)
        ->and($response->ratelimitWindowSeconds)->toBe(900)
        ->and($response->ratelimitRemaining)->toBe(1750)
        ->and($response->ratelimitUsed)->toBe(50);
});

it('parses rate limit limit without window suffix', function () {
    $response = new EsiResponse('{}', ['X-Ratelimit-Limit' => ['300']], 'now', 200);

    expect($response->ratelimitLimit)->toBe(300)
        ->and($response->ratelimitWindowSeconds)->toBeNull();
});

it('parses rate limit window in minutes', function () {
    $response = new EsiResponse('{}', ['X-Ratelimit-Limit' => ['600/10m']], 'now', 200);

    expect($response->ratelimitWindowSeconds)->toBe(600);
});

it('parses rate limit window in hours', function () {
    $response = new EsiResponse('{}', ['X-Ratelimit-Limit' => ['3600/1h']], 'now', 200);

    expect($response->ratelimitWindowSeconds)->toBe(3600);
});

it('parses rate limit window in seconds', function () {
    $response = new EsiResponse('{}', ['X-Ratelimit-Limit' => ['60/30s']], 'now', 200);

    expect($response->ratelimitWindowSeconds)->toBe(30);
});

it('parses Retry-After header', function () {
    $response = new EsiResponse('{}', ['Retry-After' => ['45']], 'now', 429);

    expect($response->retryAfter)->toBe(45);
});

it('returns null for missing rate limit headers', function () {
    $response = new EsiResponse('{}', [], 'now', 200);

    expect($response->ratelimitGroup)->toBeNull()
        ->and($response->ratelimitLimit)->toBeNull()
        ->and($response->ratelimitWindowSeconds)->toBeNull()
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

it('data property holds the decoded json body', function () {
    $raw = json_encode(['ticker' => 'TEST', 'member_count' => 100]);
    $response = new EsiResponse($raw, [], 'now', 200);

    expect($response->data->ticker)->toBe('TEST')
        ->and($response->data->member_count)->toBe(100);
});
