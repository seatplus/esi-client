<?php

use Kevinrob\GuzzleCache\CacheMiddleware;
use Seatplus\EsiClient\CacheMiddleware\NullCacheMiddleware;
use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Log\NullLogger;
use Seatplus\EsiSchema\GeneratedSpec;

it('initializes with default values', function () {
    $config = new EsiConfiguration;

    expect($config->httpUserAgent)->toContain('seatplus/esi-client/')
        ->toContain('+https://github.com/seatplus/esi-client')
        ->and($config->datasource)->toBe('tranquility')
        ->and($config->esiScheme)->toBe('https')
        ->and($config->esiHost)->toBe('esi.evetech.net')
        ->and($config->esiPort)->toBe(443)
        ->and($config->logfileLocation)->toBe('logs/')
        ->and($config->logMaxFiles)->toBe(10)
        ->and($config->cacheMiddleware)->toBe(NullCacheMiddleware::class)
        ->and($config->fetcher)->toBe(GuzzleFetcher::class)
        ->and($config->compatibilityDate)->toBe(GeneratedSpec::COMPATIBILITY_DATE);
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

it('compatibilityDate can be set via constructor', function () {
    $config = new EsiConfiguration(compatibilityDate: '2025-10-01');

    expect($config->compatibilityDate)->toBe('2025-10-01');
});

it('compatibilityDate defaults to the date esi-schema was generated for', function () {
    EsiConfiguration::resetInstance();
    $config = EsiConfiguration::getInstance();

    expect($config->compatibilityDate)->toBe(GeneratedSpec::COMPATIBILITY_DATE);

    EsiConfiguration::resetInstance();
});
