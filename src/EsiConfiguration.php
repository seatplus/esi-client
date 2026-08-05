<?php

declare(strict_types=1);

namespace Seatplus\EsiClient;

use Composer\InstalledVersions;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Monolog\Level;
use Seatplus\EsiClient\CacheMiddleware\NullCacheMiddleware;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\LogInterface;
use Seatplus\EsiClient\Log\RotatingFileLogger;
use Seatplus\EsiSchema\GeneratedSpec;

class EsiConfiguration
{
    private static ?EsiConfiguration $instance = null;

    private ?LogInterface $loggerImplementation = null;

    private ?CacheMiddleware $cacheImplementation = null;

    /**
     * The promoted properties below stay snake_case on purpose: they are config keys, not
     * ordinary properties. Consumers map them 1:1 onto Laravel config entries
     * (`config('eveapi.config.esi-client.logfile_location')`) and EsiClient reads several of
     * them dynamically by name (`getConfiguration('esi_scheme')`). Per Spatie/Laravel
     * guidelines config keys remain snake_case — see seatplus/core#235.
     */
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
        // Sent on every request. Sourced from seatplus/esi-schema, which is generated
        // against exactly this spec date, so the DTOs and the wire contract cannot drift
        // apart. Pass null to omit the header and let ESI apply its own default.
        public ?string $compatibility_date = GeneratedSpec::COMPATIBILITY_DATE,
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
        return $this->loggerImplementation ??= new $this->logger;
    }

    public function getCacheMiddleware(): CacheMiddleware
    {
        return $this->cacheImplementation ??= (new $this->cache_middleware)->getCacheMiddleware();
    }
}
