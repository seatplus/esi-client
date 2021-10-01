<?php

it('is possible to create EsiAuthenticationContainer without esi id and secret', function () {
    $authenticaton = new \Seatplus\EsiClient\DataTransferObjects\EsiAuthentication([
        'access_token' => 'access_token',
        'refresh_token' => 'access_token',
        'token_expires' => 'now',
    ]);

    expect($authenticaton)
        ->toBeInstanceOf(\Seatplus\EsiClient\DataTransferObjects\EsiAuthentication::class)
        ->token_expires->toBe('now');
});
