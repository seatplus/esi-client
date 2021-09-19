<?php

use Seatplus\EsiClient\EsiClient;

beforeEach(fn() => $this->client = new EsiClient);

it('uses latest version endpoint', function (){

   expect($this->client->getVersion())->toBe('latest');
});

test('one can set version manually', function (){

    $this->client->setVersion('v4');

    expect($this->client->getVersion())->toBe('v4');
});

test('one can set query parameters', function () {

    $test_array = ['foo' => 'bar'];

    $this->client->setQueryParameters($test_array);

    expect($this->client->getQueryParameters())->toBe($test_array);
});

test('one can set authentication', function () {

    $authentication = buildEsiAuthentication([]);

    $this->client->setAuthentication($authentication);

    expect($this->client->getAuthentication())->toBe($authentication);
});
