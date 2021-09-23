<?php

namespace Seatplus\EsiClient\CacheMiddleware;

use Kevinrob\GuzzleCache\CacheMiddleware;

interface CacheMiddlewareInterface
{
    public function getCacheMiddleware() : CacheMiddleware;
}
