<?php

use Illuminate\Contracts\Cache\Repository;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Seatplus\EsiClient\CacheMiddleware\LaravelFileCacheMiddleware;

it('returns a CacheMiddleware instance', function () {
    // Mock the Cache facade
    $cacheMock = mock('alias:Illuminate\Support\Facades\Cache');

    $cacheStoreMock = mock(Repository::class, function ($mock) {
        $mock->shouldReceive('getName')->andReturn('file');
    });
    $cacheMock->shouldReceive('store')->with('file')->andReturn($cacheStoreMock);

    $middleware = new LaravelFileCacheMiddleware;
    $result = $middleware->getCacheMiddleware();

    expect($result)->toBeInstanceOf(CacheMiddleware::class);

    Mockery::close();
});
