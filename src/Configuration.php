<?php

namespace Seatplus\EsiClient;

use Kevinrob\GuzzleCache\CacheMiddleware;
use Seatplus\EsiClient\DataTransferObjects\EsiConfiguration;
use Seatplus\EsiClient\Log\LogInterface;

class Configuration
{
    private static ?Configuration $instance = null;
    private EsiConfiguration $configuration;
    private ?LogInterface $logger_implementation = null;
    private ?CacheMiddleware $cache_middleware = null;

    public function __construct()
    {
        $this->configuration = new EsiConfiguration;
    }

    public static function getInstance(): self
    {

        if (is_null(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

    public function getLogger(): LogInterface
    {
        if (! $this->logger_implementation)
            $this->logger_implementation = new $this->configuration->logger;

        return $this->logger_implementation;
    }

    public function getCacheMiddleware(): CacheMiddleware
    {
        if (!$this->cache_middleware)
            $this->cache_middleware = (new $this->configuration->cache_middleware)->getCacheMiddleware();

        return $this->cache_middleware;
    }

    /**
     * Magic method to get the configuration from the configuration
     * property.
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {

        return $this->configuration->$name;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return string
     */
    public function __set(string $name, string $value)
    {

        return $this->configuration->$name = $value;
    }
}
