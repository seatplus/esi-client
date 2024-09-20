<?php

use Seatplus\EsiClient\Log\NullLogger;

it('logs message without error', function () {
    $logger = new NullLogger();
    $logger->log('This is a log message');
    expect(true)->toBeTrue(); // No exception should be thrown
});

it('logs debug message without error', function () {
    $logger = new NullLogger();
    $logger->debug('This is a debug message');
    expect(true)->toBeTrue(); // No exception should be thrown
});

it('logs warning message without error', function () {
    $logger = new NullLogger();
    $logger->warning('This is a warning message');
    expect(true)->toBeTrue(); // No exception should be thrown
});

it('logs error message without error', function () {
    $logger = new NullLogger();
    $logger->error('This is an error message');
    expect(true)->toBeTrue(); // No exception should be thrown
});
