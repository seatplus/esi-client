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

    public function __construct(
        public string $httpUserAgent = '',

        // Esi
        public string $datasource = 'tranquility',
        public string $esiScheme = 'https',
        public string $esiHost = 'esi.evetech.net',
        public int $esiPort = 443,

        // Logging
        public string $logger = RotatingFileLogger::class,
        public int $loggerLevel = Level::Info->value,
        public string $logfileLocation = 'logs/',

        // Rotating Logger Details
        public int $logMaxFiles = 10,

        // cache stack
        public string $cacheMiddleware = NullCacheMiddleware::class,

        // Fetching
        public string $fetcher = GuzzleFetcher::class,

        // Versioning — X-Compatibility-Date header value (YYYY-MM-DD).
        // Sent on every request. Sourced from seatplus/esi-schema, which is generated
        // against exactly this spec date, so the DTOs and the wire contract cannot drift
        // apart. Pass null to omit the header and let ESI apply its own default.
        public ?string $compatibilityDate = GeneratedSpec::COMPATIBILITY_DATE,
    ) {
        if ($this->httpUserAgent === '') {
            $version = InstalledVersions::getPrettyVersion('seatplus/esi-client') ?? 'dev';
            $this->httpUserAgent = "seatplus/esi-client/{$version} +https://github.com/seatplus/esi-client";
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
        return $this->cacheImplementation ??= (new $this->cacheMiddleware)->getCacheMiddleware();
    }
}
