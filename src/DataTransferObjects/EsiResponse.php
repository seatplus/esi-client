<?php

namespace Seatplus\EsiClient\DataTransferObjects;

use ArrayObject;

class EsiResponse extends ArrayObject
{
    public array $parsed_headers;
    public object $data;
    public ?int $error_limit_remain;
    public ?int $pages;
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
        $this->error_limit_remain = $this->getErrorLimitRemain($this->parsed_headers);
        $this->pages = $this->getPages($this->parsed_headers);

        $this->error_message = $this->parseErrorMessage($raw);
        $this->cache_loaded = $this->isCachedLoad();

        parent::__construct((object) json_decode($raw), ArrayObject::ARRAY_AS_PROPS);
    }

    public function isCachedLoad(): bool
    {
        return $this->get_data($this->parsed_headers, 'X-Kevinrob-Cache', false) === 'HIT';
    }

    private function parseHeaders(array $headers): array
    {
        return array_map(fn($value) => is_array($value) ? implode(';', $value) : $value, $headers);
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
        return $this->hasHeader($stack, $needle) ? $this->getHeader($stack, $needle): $default;
    }

    private function getErrorLimitRemain(array $parsed_headers): ?int
    {
        return $this->get_data($parsed_headers, 'X-Esi-Error-Limit-Remain');
    }

    private function getPages(array $parsed_headers)
    {
        return $this->get_data($parsed_headers, 'X-Pages');
    }

    private function parseErrorMessage(string $data): string
    {
        $data = (object) json_decode($data);
        $error_message = $data->error ?? '';
        if (property_exists($data, 'error_description')) {
            $error_message .= ': ' . $data->error_description;
        }
        return $error_message;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage(): mixed
    {
        return $this->error_message;
    }
}
