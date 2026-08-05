<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\DataTransferObjects;

/**
 * @template TData of object
 */
class EsiResponse
{
    public array $parsedHeaders;

    /**
     * The decoded JSON body of the ESI response.
     *
     * @var TData
     */
    public object $data;

    public ?int $errorLimitRemain;

    public ?int $errorLimitReset;

    public ?int $pages;

    // Rate-limit headers (floating-window system, live as of 2025)
    public ?string $ratelimitGroup;

    /** The token count from X-Ratelimit-Limit, e.g. 1800 from "1800/15m". */
    public ?int $ratelimitLimit;

    /** The window duration in seconds from X-Ratelimit-Limit, e.g. 900 from "1800/15m". */
    public ?int $ratelimitWindowSeconds;

    public ?int $ratelimitRemaining;

    public ?int $ratelimitUsed;

    /** Seconds to wait before retrying; present on 429 responses. */
    public ?int $retryAfter;

    protected string $expiresAt;

    protected ?string $errorMessage;

    protected bool $cacheLoaded = false;

    public function __construct(
        public string $raw,
        public array $rawHeaders,
        string $expires,
        protected int $responseCode
    ) {
        $this->expiresAt = strlen($expires) > 2 ? $expires : 'now';

        $parsedHeaders = $this->parseHeaders($rawHeaders);
        $this->parsedHeaders = $parsedHeaders;
        $this->errorLimitRemain = $this->getIntHeader($parsedHeaders, 'X-Esi-Error-Limit-Remain');
        $this->errorLimitReset = $this->getIntHeader($parsedHeaders, 'X-Esi-Error-Limit-Reset');
        $this->pages = $this->getIntHeader($parsedHeaders, 'X-Pages');
        $this->ratelimitGroup = $this->getHeader($parsedHeaders, 'X-Ratelimit-Group');
        $this->ratelimitLimit = $this->parseRatelimitLimit($parsedHeaders);
        $this->ratelimitWindowSeconds = $this->parseRatelimitWindowSeconds($parsedHeaders);
        $this->ratelimitRemaining = $this->getIntHeader($parsedHeaders, 'X-Ratelimit-Remaining');
        $this->ratelimitUsed = $this->getIntHeader($parsedHeaders, 'X-Ratelimit-Used');
        $this->retryAfter = $this->getIntHeader($parsedHeaders, 'Retry-After');

        $this->errorMessage = $this->parseErrorMessage($raw);
        $this->cacheLoaded = $this->isCachedLoad();

        $this->data = (object) json_decode($raw);
    }

    public function isCachedLoad(): bool
    {
        return $this->getData($this->parsedHeaders, 'X-Kevinrob-Cache', false) === 'HIT';
    }

    /**
     * Returns true when the floating-window rate limit bucket is running low (< 10% remaining).
     * Only meaningful once ESI starts returning X-Ratelimit-* headers for the endpoint.
     */
    public function isRateLimitLow(): bool
    {
        if ($this->ratelimitRemaining === null || $this->ratelimitLimit === null || $this->ratelimitLimit === 0) {
            return false;
        }

        return ($this->ratelimitRemaining / $this->ratelimitLimit) < 0.10;
    }

    public function getErrorMessage(): mixed
    {
        return $this->errorMessage;
    }

    private function parseHeaders(array $headers): array
    {
        return array_map(fn (mixed $value) => is_array($value) ? implode(';', $value) : $value, $headers);
    }

    private function hasHeader(array $headers, string $name): bool
    {
        return array_key_exists(strtolower($name), array_change_key_case($headers, CASE_LOWER));
    }

    private function getHeader(array $headers, string $name): ?string
    {
        $keyMap = array_change_key_case($headers, CASE_LOWER);

        return $keyMap[strtolower($name)] ?? null;
    }

    private function getData(array $stack, string $needle, mixed $default = null): mixed
    {
        return $this->hasHeader($stack, $needle) ? $this->getHeader($stack, $needle) : $default;
    }

    private function getIntHeader(array $headers, string $name): ?int
    {
        $value = $this->getHeader($headers, $name);

        return $value !== null ? (int) $value : null;
    }

    /** Parse "1800/15m" format — returns only the numeric token count. */
    private function parseRatelimitLimit(array $headers): ?int
    {
        $value = $this->getHeader($headers, 'X-Ratelimit-Limit');
        if ($value === null) {
            return null;
        }

        return (int) explode('/', $value)[0];
    }

    /**
     * Parse "1800/15m" format — returns the window duration in seconds.
     * Supports units: s (seconds), m (minutes), h (hours).
     */
    private function parseRatelimitWindowSeconds(array $headers): ?int
    {
        $value = $this->getHeader($headers, 'X-Ratelimit-Limit');
        if ($value === null || ! str_contains($value, '/')) {
            return null;
        }

        $window = explode('/', $value)[1];

        $amount = (int) $window;
        $unit = strtolower(preg_replace('/[0-9]/', '', $window));

        return match ($unit) {
            'm' => $amount * 60,
            'h' => $amount * 3600,
            default => $amount, // 's' or bare number
        };
    }

    private function parseErrorMessage(string $data): string
    {
        $data = (object) json_decode($data);
        $errorMessage = $data->error ?? '';

        if (property_exists($data, 'error_description')) {
            $errorMessage .= ": {$data->error_description}";
        }

        return $errorMessage;
    }
}
