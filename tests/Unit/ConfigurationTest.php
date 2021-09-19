<?php

use Seatplus\EsiClient\Configuration;

test('one can change to rotating logger instance', function () {
    $config = Configuration::getInstance();

    $config->setConfiguration(new \Seatplus\EsiClient\DataTransferObjects\EsiConfiguration([
        'logger' => \Seatplus\EsiClient\Log\RotatingFileLogger::class
    ]));

    expect($config->getLogger())->toBeInstanceOf(\Seatplus\EsiClient\Log\RotatingFileLogger::class);
});

test('one can change null logger instance', function () {
    $config = Configuration::getInstance();

    $config->setConfiguration(new \Seatplus\EsiClient\DataTransferObjects\EsiConfiguration([
        'logger' => \Seatplus\EsiClient\Log\NullLogger::class
    ]));

    expect($config->getLogger())->toBeInstanceOf(\Seatplus\EsiClient\Log\NullLogger::class);
});

test('one can change cache to null middleware logger instance', function () {
    $config = Configuration::getInstance();

    $config->setConfiguration(new \Seatplus\EsiClient\DataTransferObjects\EsiConfiguration([
        'cache_middleware' => \Seatplus\EsiClient\CacheMiddleware\NullCacheMiddleware::class
    ]));

    expect($config->getCacheMiddleware())->toBeInstanceOf(\Kevinrob\GuzzleCache\CacheMiddleware::class);
});
