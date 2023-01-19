<?php

namespace Seatplus\EsiClient\DataTransferObjects;

use Monolog\Logger;
use Seatplus\EsiClient\CacheMiddleware\NullCacheMiddleware;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\RotatingFileLogger;

class EsiConfiguration
{
    public function __construct(
        public string $http_user_agent = "Seatplus Esi Client Default Library",

        // Esi
        public string $datasource = 'tranquility',
        public string $esi_scheme = 'https',
        public string $esi_host = 'esi.evetech.net',
        public int $esi_port = 443,

        // Eve SSO v2
        public string $sso_scheme = 'https',
        public string $sso_host = 'login.eveonline.com',
        public int $sso_port = 443,

        // Logging
        public string $logger = RotatingFileLogger::class,
        public int $logger_level = Logger::INFO,
        public string $logfile_location = 'logs/',

        // Rotating Logger Details
        public int $log_max_files = 10,

        //cache stack
        public string $cache_middleware = NullCacheMiddleware::class,

        // Fetching
        public string $fetcher = GuzzleFetcher::class,
    )
    {
    }


}
