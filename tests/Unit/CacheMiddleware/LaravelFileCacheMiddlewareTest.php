<?php

use Illuminate\Contracts\Cache\Repository;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Seatplus\EsiClient\CacheMiddleware\LaravelFileCacheMiddleware;
use Seatplus\EsiClient\CacheMiddleware\Strategy\EsiPrivateCacheStrategy;

it('returns a CacheMiddleware instance', function () {
    // Mock the Cache facade
    $cacheMock = mock('alias:Illuminate\Support\Facades\Cache');

    $cacheStoreMock = mock(Repository::class, function ($mock) {
        $mock->shouldReceive('getName')->andReturn('file');
    });
    $cacheMock->shouldReceive('store')->with('file')->andReturn($cacheStoreMock);

    $middleware = new LaravelFileCacheMiddleware;
    $result = $middleware->getCacheMiddleware();

    // getCacheStorage() returns the strategy, despite the name. Asserting it pins the wiring:
    // without this the test would pass just as happily on the unscoped PrivateCacheStrategy.
    expect($result)->toBeInstanceOf(CacheMiddleware::class)
        ->and($result->getCacheStorage())->toBeInstanceOf(EsiPrivateCacheStrategy::class);

    Mockery::close();
});
