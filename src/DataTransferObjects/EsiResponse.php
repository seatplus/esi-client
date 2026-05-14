<?php

namespace Seatplus\EsiClient\DataTransferObjects;

/**
 * @template TData of object
 */
class EsiResponse
{
    public array $parsed_headers;

    /**
     * The decoded JSON body of the ESI response.
     *
     * @var TData
     */
    public object $data;

    public ?int $error_limit_remain;

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

    protected string $expires_at;

    protected ?string $error_message;

    protected bool $cache_loaded = false;

    public function __construct(
        public string $raw,
        public array $raw_headers,
        string $expires,
        protected int $response_code
    ) {
        $this->expires_at = strlen($expires) > 2 ? $expires : 'now';

        $parsed_headers = $this->parseHeaders($raw_headers);
        $this->parsed_headers = $parsed_headers;
        $this->error_limit_remain = $this->getIntHeader($parsed_headers, 'X-Esi-Error-Limit-Remain');
        $this->pages = $this->getIntHeader($parsed_headers, 'X-Pages');
        $this->ratelimitGroup = $this->getHeader($parsed_headers, 'X-Ratelimit-Group');
        $this->ratelimitLimit = $this->parseRatelimitLimit($parsed_headers);
        $this->ratelimitWindowSeconds = $this->parseRatelimitWindowSeconds($parsed_headers);
        $this->ratelimitRemaining = $this->getIntHeader($parsed_headers, 'X-Ratelimit-Remaining');
        $this->ratelimitUsed = $this->getIntHeader($parsed_headers, 'X-Ratelimit-Used');
        $this->retryAfter = $this->getIntHeader($parsed_headers, 'Retry-After');

        $this->error_message = $this->parseErrorMessage($raw);
        $this->cache_loaded = $this->isCachedLoad();

        $this->data = (object) json_decode($raw);
    }

    public function isCachedLoad(): bool
    {
        return $this->get_data($this->parsed_headers, 'X-Kevinrob-Cache', false) === 'HIT';
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
        return $this->error_message;
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
        $key_map = array_change_key_case($headers, CASE_LOWER);

        return $key_map[strtolower($name)] ?? null;
    }

    private function get_data(array $stack, string $needle, mixed $default = null): mixed
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
        $error_message = $data->error ?? '';
        if (property_exists($data, 'error_description')) {
            $error_message .= ': '.$data->error_description;
        }

        return $error_message;
    }
}
