# Esi-Client

[![Latest Stable Version](https://poser.pugx.org/seatplus/esi-client/v/stable)](https://packagist.org/packages/seatplus/esi-client)
[![Tests](https://github.com/seatplus/esi-client/actions/workflows/tests.yml/badge.svg)](https://github.com/seatplus/esi-client/actions/workflows/tests.yml)
[![Formats](https://github.com/seatplus/esi-client/actions/workflows/formats.yml/badge.svg)](https://github.com/seatplus/esi-client/actions/workflows/formats.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/642d3b3ca41e7cc3cd4f/maintainability)](https://codeclimate.com/github/seatplus/esi-client/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/642d3b3ca41e7cc3cd4f/test_coverage)](https://codeclimate.com/github/seatplus/esi-client/test_coverage)
[![Total Downloads](https://poser.pugx.org/seatplus/esi-client/downloads)](https://packagist.org/packages/seatplus/esi-client)
[![License](https://poser.pugx.org/seatplus/esi-client/license)](https://packagist.org/packages/seatplus/esi-client)

A standalone ESI (Eve Swagger Interface) Client Library using kevinrob/guzzle-cache-middleware.

> **ESI compatibility date:** This branch of `esi-client` targets ESI compatibility date **`2025-12-16`** and forward.
> Responses DTOs are sourced from [`seatplus/esi-schema`](https://github.com/seatplus/esi-schema) (`1.x`).
> If CCP publishes a new breaking compatibility date, a new major version of both packages will be released.

## Installation

You can install the package via composer:

```bash
composer require seatplus/esi-client
```


## Usage

### Typed SDK (recommended)

The SDK exposes typed resource methods. Single-object endpoints return the DTO directly (a subclass of `AbstractEsiDto`); paginated list endpoints return `EsiResult<array<T>>`.

```php
use Seatplus\EsiClient\EsiClient;

$sdk = new EsiClient();

// Single object — returns AllianceDetail directly
$alliance = $sdk->alliance()->getAlliancesAllianceId(99000006);
echo $alliance->name;          // typed readonly string
echo $alliance->ticker;
$alliance->isCachedLoad;       // bool — true if served from RFC 7234 cache

// Authenticated endpoint — returns CharactersDetail directly
$character = $sdk->withToken($accessToken)->characters()->getCharactersCharacterId(95725047);
echo $character->name;

// Paginated list — returns EsiResult (pages metadata needed)
$result = $sdk->withToken($accessToken)->assets()->getCharactersCharacterIdAssets(95725047, page: 1);
echo $result->pages;           // total pages from X-Pages header
foreach ($result->data as $asset) {
    echo $asset->item_id;      // typed readonly int
}
```

### Low-level transport

```php
$esi = new EsiClient();

// make a call — returns EsiResponse
$response = $esi->invoke('get', '/characters/{character_id}/', [
    'character_id' => 95725047,
]);

// $response->data    — stdClass decoded from the JSON body
// $response->pages   — total pages (from X-Pages header, or 1)
// $response->isCachedLoad() — true if served from RFC 7234 cache
```

### Rate limiting

ESI enforces a **1800-token / 15-minute** rolling window (one token consumed per request,
irrespective of response code). `esi-client` itself does not throttle — rate limiting is
handled by the consumer layer (`eveapi`) using Laravel Horizon throttle middleware on each
queued job.

If the HTTP client receives a `420 Error Limited` response, the request is retried with
exponential backoff as configured on the job.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

As of today this esi client only supports Laravel Cache Middleware. However [`Kevinrob/guzzle-cache-middleware`](https://github.com/Kevinrob/guzzle-cache-middleware) supports various others such as:
* Doctrine cache 
* Laravel cache 
* Flysystem 
* PSR6 
* WordPress Object Cache

if you plan to use this client with any of these a proper CacheMiddleware would be needed.
Same goes to the HTTP client. This client and its cache middleware had been designed to use with Guzzle7 (but you can use it with any PSR-7 HTTP client). Please submit your PR accordingly implementing other HTTP clients.

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Felix Huber](https://github.com/seatplus)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
