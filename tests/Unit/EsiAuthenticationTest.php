<?php

use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;

it('is possible to create EsiAuthenticationContainer without esi id and secret', function () {
    $authenticaton = new EsiAuthentication(
        accessToken: 'access_token',
        refreshToken: 'refresh_token',
        tokenExpires: 'now',
    );

    expect($authenticaton)
        ->toBeInstanceOf(EsiAuthentication::class)
        ->tokenExpires->toBe('now');
});

it('derives the expiry from the access token JWT exp claim', function () {
    $exp = strtotime('2030-06-15 12:34:56');

    $token = buildJWT(json_encode(['exp' => $exp]));

    expect(EsiAuthentication::expiresFromToken($token))
        ->toBe(date('Y-m-d H:i:s', $exp));
});

it('falls back to epoch when the token is malformed or has no exp', function () {
    expect(EsiAuthentication::expiresFromToken('not-a-jwt'))
        ->toBe('1970-01-01 00:00:00')
        ->and(EsiAuthentication::expiresFromToken(buildJWT(json_encode(['scp' => []]))))
        ->toBe('1970-01-01 00:00:00');
});
