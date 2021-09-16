<?php

namespace Seatplus\EsiClient\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class EsiResponse extends DataTransferObject
{
    public string $raw;
    public array $headers;
    public array $raw_headers;

    public ?int $error_limit_remain;
    public ?int $pages;

    protected string $expires_at;
    protected string $response_code;

    /**
     * @var mixed
     */
    protected ?string $error_message;

    /**
     * @var bool
     */
    protected bool $cached_load = false;

    public function __construct(string $data, array $headers, string $expires, int $response_code)
    {
        $parsed_headers = $this->parseHeaders($headers);

        $construct_array = [
            'raw' => $data,
            'raw_headers' => $headers,
            'data' => (object) json_decode($data),
            'headers' => $parsed_headers,
            'error_limit_remain' => $this->getErrorLimitRemain($parsed_headers),
            'pages' => $this->getPages($parsed_headers),
            'expires_at' => strlen($expires) > 2 ? $expires : 'now',
            'response_code' => $response_code,
            'error_message' => $this->parseErrorMessage($data),
        ];

        parent::__construct($construct_array);
    }

    public function isCachedLoad(): bool
    {
        return $this->get_data($this->headers, 'X-Kevinrob-Cache', false) === 'HIT';
    }

    private function parseHeaders(array $headers): array
    {
        // flatten the headers array so that values are not arrays themselves
        // but rather simple key value pairs.
        return array_map(function ($value) {
            if (! is_array($value)) {
                return $value;
            }

            return implode(';', $value);
        }, $headers);
    }

    private function hasHeader(array $headers, string $name): bool
    {
        // turn headers into case insensitive array
        $key_map = array_change_key_case($headers, CASE_LOWER);

        // track for the requested header name
        return array_key_exists(strtolower($name), $key_map);
    }

    private function getHeader(array $headers, string $name): ?string
    {
        // turn header name into case insensitive
        $insensitive_key = strtolower($name);

        // turn headers into case insensitive array
        $key_map = array_change_key_case($headers, CASE_LOWER);

        // track for the requested header name and return its value if exists
        if (array_key_exists($insensitive_key, $key_map)) {
            return $key_map[$insensitive_key];
        }

        return null;
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

    private function parseErrorMessage(string $data): ?string
    {
        $error_message = '';
        $data = (object) json_decode($data);

        // If there is an error, set that.
        if (property_exists($data, 'error')) {
            $error_message = $data->error;
        }

        // If there is an error description, set that.
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
        if (! isset($this->error_message)) {
            $this->error_message = '';
        }

        return $this->error_message;
    }
}
