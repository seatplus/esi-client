<?php

namespace Seatplus\EsiClient\CacheMiddleware;

use Illuminate\Support\Facades\Cache;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;

class LaravelFileCacheMiddleware implements CacheMiddlewareInterface
{

    public function getCacheMiddleware(): CacheMiddleware
    {
        return new CacheMiddleware(
            new PrivateCacheStrategy(
                new LaravelCacheStorage(
                    Cache::store('file')
                )
            )
        );
    }
}
