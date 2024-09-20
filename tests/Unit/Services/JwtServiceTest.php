<?php

use Seatplus\EsiClient\Services\JwtService;
use Firebase\JWT\JWT;

afterEach(function () {
    Mockery::close();
});

it('decodes JWT successfully', function () {
    $keyId = 'test_kid';
    $jwt = JWT::encode(['data' => 'decoded_data'], 'secret', 'HS256', $keyId);
    $keys = [$keyId => 'secret'];
    $allowedAlgs = ['HS256'];

    $service = new JwtService();

    $result = $service->decodeJWT($jwt, $keys, $allowedAlgs);

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
                'alg' => 'RS256'
            ]
        ]
    ];

    $service = new JwtService();

    $result = $service->parseJWKS($decodedJson);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('1b94c');
});

it('throws exception on invalid JWT', function () {
    $jwt = 'invalid_jwt';
    $keys = ['secret' => 'secret'];
    $allowedAlgs = ['HS256'];

    $service = new JwtService();

    expect(fn() => $service->decodeJWT($jwt, $keys, $allowedAlgs))
        ->toThrow(\UnexpectedValueException::class);
});

