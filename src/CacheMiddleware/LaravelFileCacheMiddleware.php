<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\CacheMiddleware;

use Illuminate\Support\Facades\Cache;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Seatplus\EsiClient\CacheMiddleware\Strategy\EsiPrivateCacheStrategy;

class LaravelFileCacheMiddleware implements CacheMiddlewareInterface
{
    #[\Override]
    public function getCacheMiddleware(): CacheMiddleware
    {
        return new CacheMiddleware(
            new EsiPrivateCacheStrategy(
                new LaravelCacheStorage(
                    Cache::store('file')
                )
            )
        );
    }
}
