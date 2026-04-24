<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Seatplus\EsiClient\Services\JwtService;

afterEach(function () {
    Mockery::close();
});

it('decodes JWT successfully', function () {
    $secret = str_repeat('a', 32); // HS256 requires min 256-bit (32-byte) key
    $keyId = 'test_kid';
    $jwt = JWT::encode(['data' => 'decoded_data'], $secret, 'HS256', $keyId);
    $keys = [$keyId => new Key($secret, 'HS256')];

    $service = new JwtService;

    $result = $service->decodeJWT($jwt, $keys);

    expect($result->data)->toBe('decoded_data');
});

it('parses JWKS successfully', function () {
    $decodedJson = [
        'keys' => [
            [
                'kty' => 'RSA',
                'kid' => '1b94c',
                'use' => 'sig',
                'n' => 'vrjOfz...',
                'e' => 'AQAB',
                'alg' => 'RS256',
            ],
        ],
    ];

    $service = new JwtService;

    $result = $service->parseJWKS($decodedJson);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('1b94c');
});

it('throws exception on invalid JWT', function () {
    $jwt = 'invalid_jwt';
    $keys = ['secret' => new Key(str_repeat('a', 32), 'HS256')];

    $service = new JwtService;

    expect(fn () => $service->decodeJWT($jwt, $keys))
        ->toThrow(UnexpectedValueException::class);
});
