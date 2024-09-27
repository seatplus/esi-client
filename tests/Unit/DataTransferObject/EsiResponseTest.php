<?php

use Seatplus\EsiClient\DataTransferObjects\EsiResponse;

it('parses headers correctly', function () {
    $raw_headers = [
        'X-Esi-Error-Limit-Remain' => ['100'],
        'X-Pages' => ['5'],
        'X-Kevinrob-Cache' => ['HIT'],
        123
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->parsed_headers['X-Esi-Error-Limit-Remain'])->toBe('100')
        ->and($response->parsed_headers['X-Pages'])->toBe('5')
        ->and($response->parsed_headers['X-Kevinrob-Cache'])->toBe('HIT');
});

it('detects cache load correctly', function () {
    $raw_headers = [
        'X-Kevinrob-Cache' => ['HIT']
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
        'X-Esi-Error-Limit-Remain' => ['100']
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->error_limit_remain)->toBe(100);
});

it('parses pages correctly', function () {
    $raw_headers = [
        'X-Pages' => ['5']
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    expect($response->pages)->toBe(5);
});

it('returns null when header is not found', function () {
    $raw_headers = [
        'X-Esi-Error-Limit-Remain' => ['100'],
        'X-Pages' => ['5']
    ];
    $response = new EsiResponse('{}', $raw_headers, 'now', 200);

    $reflection = new \ReflectionClass($response);
    $method = $reflection->getMethod('getHeader');

    $result = $method->invokeArgs($response, [$raw_headers, 'Non-Existent-Header']);

    expect($result)->toBeNull();
});
