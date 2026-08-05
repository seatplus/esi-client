<?php

use Monolog\Level;
use org\bovigo\vfs\vfsStream;
use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Log\RotatingFileLogger;

beforeEach(function () {
    EsiConfiguration::resetInstance();
});

afterEach(function () {
    EsiConfiguration::resetInstance();
});

it('writes error log', function () {
    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->error('foo');
    $logfileName = 'esi-client-'.date('Y-m-d').'.log';

    $logfileContent = $root->getChild($logfileName)->getContent();

    expect($logfileContent)->toContain('esi-client.ERROR: foo');
});

it('writes warning log', function () {
    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->warning('foo');
    $logfileName = 'esi-client-'.date('Y-m-d').'.log';

    $logfileContent = $root->getChild($logfileName)->getContent();

    expect($logfileContent)->toContain('esi-client.WARNING: foo');
});

it('writes info log', function () {
    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->log('foo');
    $logfileName = 'esi-client-'.date('Y-m-d').'.log';

    $logfileContent = $root->getChild($logfileName)->getContent();

    expect($logfileContent)->toContain('esi-client.INFO: foo');
});

it('writes debug log', function () {
    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->debug('foo');
    $logfileName = 'esi-client-'.date('Y-m-d').'.log';

    $logfileContent = $root->getChild($logfileName)->getContent();

    expect($logfileContent)->toContain('esi-client.DEBUG: foo');
});
