<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\CacheMiddleware;

use Kevinrob\GuzzleCache\CacheMiddleware;

interface CacheMiddlewareInterface
{
    public function getCacheMiddleware(): CacheMiddleware;
}
