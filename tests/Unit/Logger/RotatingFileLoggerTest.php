<?php

use Monolog\Logger;
use org\bovigo\vfs\vfsStream;
use Seatplus\EsiClient\Configuration;
use Seatplus\EsiClient\Log\RotatingFileLogger;

beforeEach(function () {
    // Set the file cache path in the config singleton
    $this->root = vfsStream::setup('logs');
    Configuration::getInstance()->logfile_location = $this->root->url();
    Configuration::getInstance()->logger_level = \Monolog\Logger::INFO;

    $this->logger = new RotatingFileLogger;

    # Shitty hack to get the filename to expect. Format: eseye-2018-05-06.log
    $this->logfile_name = 'esi-client-' . date('Y-m-d') . '.log';
});

afterEach(function () {

    Configuration::getInstance()->logfile_location = 'logs/';
});

it('writes info log', function () {

    $this->logger->log('foo');
    $logfile_content = $this->root->getChild($this->logfile_name)->getContent();

    expect($logfile_content)->toContain('esi-client.INFO: foo');
});

it('writes debug log', function () {

    Configuration::getInstance()->logger_level = Logger::DEBUG;
    $this->logger = new RotatingFileLogger;


    $this->logger->debug('foo');
    $logfile_content = $this->root->getChild($this->logfile_name)->getContent();

    expect($logfile_content)->toContain('esi-client.DEBUG: foo');
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
