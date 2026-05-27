<?php

use Kevinrob\GuzzleCache\CacheMiddleware;
use Seatplus\EsiClient\CacheMiddleware\NullCacheMiddleware;
use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Log\NullLogger;

it('initializes with default values', function () {
    $config = new EsiConfiguration;

    expect($config->http_user_agent)->toBe('')
        ->and($config->datasource)->toBe('tranquility')
        ->and($config->esi_scheme)->toBe('https')
        ->and($config->esi_host)->toBe('esi.evetech.net')
        ->and($config->esi_port)->toBe(443)
        ->and($config->sso_scheme)->toBe('https')
        ->and($config->sso_host)->toBe('login.eveonline.com')
        ->and($config->sso_port)->toBe(443)
        ->and($config->logfile_location)->toBe('logs/')
        ->and($config->log_max_files)->toBe(10)
        ->and($config->cache_middleware)->toBe(NullCacheMiddleware::class)
        ->and($config->fetcher)->toBe(GuzzleFetcher::class)
        ->and($config->compatibility_date)->toBe('2025-12-16');
});

it('singleton instance is consistent', function () {
    $config1 = EsiConfiguration::getInstance();
    $config2 = EsiConfiguration::getInstance();

    expect($config1)->toBe($config2);
});

it('getLogger returns logger instance', function () {
    $config = new EsiConfiguration;
    $logger = $config->getLogger();

    expect($logger)->toBeInstanceOf(LogInterface::class);
});

it('getCacheMiddleware returns cache middleware instance', function () {
    $config = new EsiConfiguration;
    $cacheMiddleware = $config->getCacheMiddleware();

    expect($cacheMiddleware)->toBeInstanceOf(CacheMiddleware::class);
});

it('get NullLogger through instance', function () {

    EsiConfiguration::getInstance(logger: NullLogger::class);

    $config = EsiConfiguration::getInstance();
    $logger = $config->getLogger();

    expect($logger)->toBeInstanceOf(LogInterface::class);
});

it('compatibility_date can be set via constructor', function () {
    $config = new EsiConfiguration(compatibility_date: '2025-10-01');

    expect($config->compatibility_date)->toBe('2025-10-01');
});

it('compatibility_date defaults to 2025-12-16', function () {
    EsiConfiguration::resetInstance();
    $config = EsiConfiguration::getInstance();

    expect($config->compatibility_date)->toBe('2025-12-16');

    EsiConfiguration::resetInstance();
});
