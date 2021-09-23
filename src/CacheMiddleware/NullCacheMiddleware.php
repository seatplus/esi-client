<?php

namespace Seatplus\EsiClient\CacheMiddleware;

use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Strategy\NullCacheStrategy;

class NullCacheMiddleware implements CacheMiddlewareInterface
{
    public function getCacheMiddleware(): CacheMiddleware
    {
        return  new CacheMiddleware(
            new NullCacheStrategy()
        );
    }
}
