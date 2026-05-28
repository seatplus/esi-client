<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\CacheMiddleware;

use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Strategy\NullCacheStrategy;

class NullCacheMiddleware implements CacheMiddlewareInterface
{
    #[\Override]
    public function getCacheMiddleware(): CacheMiddleware
    {
        return new CacheMiddleware(
            new NullCacheStrategy
        );
    }
}
