<?php

use Seatplus\EsiClient\Configuration;
use Seatplus\EsiClient\Log\NullLogger;
use Seatplus\EsiClient\Services\CheckAccess;

beforeEach(fn () => $this->check_access = new CheckAccess);

test('CheckAccess object initiation', function () {
    expect($this->check_access)->toBeInstanceOf(CheckAccess::class);
});

it('grants access if scope is present', function () {
    $authentication = buildEsiAuthentication([
        'access_token' => json_encode([
            'scp' => ['esi-assets.read_assets.v1'],
        ])
    ]);

    $check_access = new CheckAccess($authentication);

    $result = $check_access->can('get', '/characters/{character_id}/assets/');

    expect($result)->toBeTrue();
});

it('denies access if scope is missing', function () {
    $authentication = buildEsiAuthentication([
        'access_token' => json_encode([
            'scp' => ['esi-assets.read_assets.v1'],
        ])
    ]);

    $check_access = new CheckAccess($authentication);

    $result = $check_access->can('get', '/characters/{character_id}/bookmarks/');

    expect($result)->toBeFalse();
});

it('allows public only call', function () {
    $result = $this->check_access->can('get', '/alliances/');

    expect($result)->toBeTrue();
});

it('allows unknown url calls', function () {
    // Disable logging.
    Configuration::getInstance()->logger = NullLogger::class;

    $result = $this->check_access->can('get', '/invalid/uri');

    $this->assertTrue($result);
});
