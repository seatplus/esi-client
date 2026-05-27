<?php

namespace Seatplus\EsiClient;

use Composer\InstalledVersions;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Monolog\Level;
use Seatplus\EsiClient\CacheMiddleware\NullCacheMiddleware;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Log\RotatingFileLogger;

class EsiConfiguration
{
    private static ?EsiConfiguration $instance = null;

    private ?LogInterface $logger_implementation = null;

    private ?CacheMiddleware $cache_implementation = null;

    public function __construct(
        public string $http_user_agent = '',

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
        public int $logger_level = Level::Info->value,
        public string $logfile_location = 'logs/',

        // Rotating Logger Details
        public int $log_max_files = 10,

        // cache stack
        public string $cache_middleware = NullCacheMiddleware::class,

        // Fetching
        public string $fetcher = GuzzleFetcher::class,

        // Versioning — X-Compatibility-Date header value (YYYY-MM-DD).
        // Sent on every request. Matches the ESI OpenAPI spec compatibility date
        // used to generate seatplus/esi-schema. Update when regenerating the schema.
        public ?string $compatibility_date = '2025-12-16',
    ) {
        if ($this->http_user_agent === '') {
            $version = InstalledVersions::getPrettyVersion('seatplus/esi-client') ?? 'dev';
            $this->http_user_agent = "seatplus/esi-client/{$version} +https://github.com/seatplus/esi-client";
        }
    }

    public static function getInstance(...$args): self
    {
        return self::$instance ??= new self(...$args);
    }

    public static function resetInstance(): void
    {
        self::$instance = null;
    }

    public function getLogger(): LogInterface
    {
        return $this->logger_implementation ??= new $this->logger;
    }

    public function getCacheMiddleware(): CacheMiddleware
    {
        return $this->cache_implementation ??= (new $this->cache_middleware)->getCacheMiddleware();
    }
}
