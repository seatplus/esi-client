<?php

use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\CacheMiddleware\NullCacheMiddleware;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;

it('initializes with default values', function () {
    $config = new EsiConfiguration();

    expect($config->http_user_agent)->toBe('Seatplus Esi Client Default Library')
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
        ->and($config->fetcher)->toBe(GuzzleFetcher::class);
});

it('singleton instance is consistent', function () {
    $config1 = EsiConfiguration::getInstance();
    $config2 = EsiConfiguration::getInstance();

    expect($config1)->toBe($config2);
});

it('getLogger returns logger instance', function () {
    $config = new EsiConfiguration();
    $logger = $config->getLogger();

    expect($logger)->toBeInstanceOf(LogInterface::class);
});

it('getCacheMiddleware returns cache middleware instance', function () {
    $config = new EsiConfiguration();
    $cacheMiddleware = $config->getCacheMiddleware();

    expect($cacheMiddleware)->toBeInstanceOf(\Kevinrob\GuzzleCache\CacheMiddleware::class);
});

it('get NullLogger through instance', function () {

    EsiConfiguration::getInstance(logger: \Seatplus\EsiClient\Log\NullLogger::class);

    $config = EsiConfiguration::getInstance();
    $logger = $config->getLogger();

    expect($logger)->toBeInstanceOf(LogInterface::class);
});
