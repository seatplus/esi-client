<?php

use org\bovigo\vfs\vfsStream;
use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Log\RotatingFileLogger;

describe('log anything above info level', function () {
    beforeEach(function () {
        // Set the file cache path in the config singleton
        $this->root = vfsStream::setup('logs');
        EsiConfiguration::getInstance(
            logfile_location: $this->root->url(),
            logger_level: \Monolog\Level::Info->value
        );

        $this->logger = new RotatingFileLogger;

        # Shitty hack to get the filename to expect. Format: esi-client-2018-05-06.log
        $this->logfile_name = 'esi-client-' . date('Y-m-d') . '.log';
    });

    afterEach(function () {
        EsiConfiguration::resetInstance();
    });

    it('writes info log', function () {
        $this->logger->log('foo');
        $logfile_content = $this->root->getChild($this->logfile_name)->getContent();

        expect($logfile_content)->toContain('esi-client.INFO: foo');
    });

    it('writes warning log', function () {
        $this->logger->warning('foo');
        $logfile_content = $this->root->getChild($this->logfile_name)->getContent();

        expect($logfile_content)->toContain('esi-client.WARNING: foo');
    });

    it('writes error log', function () {
        $this->logger->error('foo');
        $logfile_content = $this->root->getChild($this->logfile_name)->getContent();

        expect($logfile_content)->toContain('esi-client.ERROR: foo');
    });
});

it('writes debug log', function () {
    //Configuration::getInstance()->logger_level = Logger::DEBUG;
    EsiConfiguration::resetInstance();

    $root = vfsStream::setup('logs');

    EsiConfiguration::getInstance(
        logfile_location: $root->url(),
        logger_level: \Monolog\Level::Debug->value
    );
    $logger = new RotatingFileLogger;

    $logger->debug('foo');
    $logfile_name = 'esi-client-' . date('Y-m-d') . '.log';

    $logfile_content = $root->getChild($logfile_name)->getContent();

    expect($logfile_content)->toContain('esi-client.DEBUG: foo');

    EsiConfiguration::resetInstance();
});
