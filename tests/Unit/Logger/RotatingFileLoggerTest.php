<?php

use org\bovigo\vfs\vfsStream;
use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Log\RotatingFileLogger;

beforeEach(function() {
    EsiConfiguration::resetInstance();
});

afterEach(function() {
    EsiConfiguration::resetInstance();
});

it('writes error log', function () {
    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: \Monolog\Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->error('foo');
    $logfile_name = 'esi-client-'.date('Y-m-d').'.log';

    $logfile_content = $root->getChild($logfile_name)->getContent();

    expect($logfile_content)->toContain('esi-client.ERROR: foo');
});

it('writes warning log', function () {
    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: \Monolog\Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->warning('foo');
    $logfile_name = 'esi-client-'.date('Y-m-d').'.log';

    $logfile_content = $root->getChild($logfile_name)->getContent();

    expect($logfile_content)->toContain('esi-client.WARNING: foo');
});

it('writes info log', function () {
    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: \Monolog\Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->log('foo');
    $logfile_name = 'esi-client-'.date('Y-m-d').'.log';

    $logfile_content = $root->getChild($logfile_name)->getContent();

    expect($logfile_content)->toContain('esi-client.INFO: foo');
});


it('writes debug log', function () {
    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: \Monolog\Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->debug('foo');
    $logfile_name = 'esi-client-'.date('Y-m-d').'.log';

    $logfile_content = $root->getChild($logfile_name)->getContent();

    expect($logfile_content)->toContain('esi-client.DEBUG: foo');
});
