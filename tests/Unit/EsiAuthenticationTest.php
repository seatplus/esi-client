<?php

use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;

it('is possible to create EsiAuthenticationContainer without esi id and secret', function () {
    $authenticaton = new EsiAuthentication(
        access_token: 'access_token',
        refresh_token: 'refresh_token',
        token_expires: 'now',
    );

    expect($authenticaton)
        ->toBeInstanceOf(EsiAuthentication::class)
        ->token_expires->toBe('now');
});
