# Esi-Client

[![Latest Stable Version](https://poser.pugx.org/seatplus/esi-client/v/stable)](https://packagist.org/packages/seatplus/esi-client)
[![Tests](https://github.com/seatplus/esi-client/actions/workflows/tests.yml/badge.svg)](https://github.com/seatplus/esi-client/actions/workflows/tests.yml)
[![Formats](https://github.com/seatplus/esi-client/actions/workflows/formats.yml/badge.svg)](https://github.com/seatplus/esi-client/actions/workflows/formats.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/642d3b3ca41e7cc3cd4f/maintainability)](https://codeclimate.com/github/seatplus/esi-client/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/642d3b3ca41e7cc3cd4f/test_coverage)](https://codeclimate.com/github/seatplus/esi-client/test_coverage)
[![Total Downloads](https://poser.pugx.org/seatplus/esi-client/downloads)](https://packagist.org/packages/seatplus/esi-client)
[![License](https://poser.pugx.org/seatplus/esi-client/license)](https://packagist.org/packages/seatplus/esi-client)

A standalone ESI (Eve Swagger Interface) Client Library using kevinrob/guzzle-cache-middleware.

> **Requires PHP 8.5.**
>
> **ESI compatibility date:** not configured here. It is read from
> [`seatplus/esi-schema`](https://github.com/seatplus/esi-schema)'s `GeneratedSpec::COMPATIBILITY_DATE`
> and sent as `X-Compatibility-Date` on every request, so the generated response DTOs and the shape the
> server returns cannot disagree. Override it with `new EsiConfiguration(compatibilityDate: '…')`, or
> pass `null` to omit the header and let ESI apply its own default. ESI validates the header and
> answers `400` for a malformed or out-of-range date, so a typo fails every request.
>
> esi-schema tags a new major for each breaking ESI spec sync, and this branch accepts that range
> (`^4.1 || ^5.0`), so **`composer update` can move the compatibility date without an esi-client
> release**. To see the date you are actually sending:
>
> ```bash
> php -r 'require "vendor/autoload.php"; echo Seatplus\EsiSchema\GeneratedSpec::COMPATIBILITY_DATE, PHP_EOL;'
> ```
>
> Pin esi-schema in your own `composer.json` if you need it frozen.

| esi-client | PHP (declared) | PHP (tested) | esi-schema | ESI compatibility date | status |
|---|---|---|---|---|---|
| `5.x` | `^8.5` | 8.5 | `^4.1 \|\| ^5.0` | from esi-schema — `2026-07-21` on `4.1.0`, `2026-08-04` on `5.0.0` | active |
| `4.x` | `^8.3` | 8.5 only | `^1.3` | `2025-12-16` (hardcoded) | bug fixes only |

`4.x` declares `php: ^8.3`, but its `require-dev` pins `pestphp/pest ^5.0`, which needs `php ^8.4` —
`composer install` of `4.x` fails on 8.3 and CI never tests below 8.5. Consumers are unaffected, since
dev dependencies are not installed for them, but that 8.3 floor is unverified.

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
$character = $sdk->withToken($accessToken)->characters()->getCharactersDetail(95725047);
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

## Caching

**There is no response cache by default.** `EsiConfiguration::$cacheMiddleware` defaults to
`NullCacheMiddleware`, which stores nothing; you opt in by setting it to `LaravelFileCacheMiddleware`
(or your own `CacheMiddlewareInterface` implementation).

When you do opt in, responses are cached per RFC 7234 and the key is scoped to both the caller and the
compatibility date — `sha256(compatibility-date | token subject | method + URI)`, via
`Seatplus\EsiClient\CacheMiddleware\Strategy\EsiPrivateCacheStrategy`. The token scoping matters: ESI
does not send `Vary: Authorization`, so an unscoped key lets two characters requesting the same
authenticated URI share one entry, and a character lacking a corporation role can be served a payload
another character fetched without ESI ever seeing the request it would have refused. The subject comes
from the access token's JWT `sub` claim, which is stable across token refresh; a token that is not a
readable JWT falls back to hashing the header, which isolates it but only caches for that token's
lifetime. Note the claim is read without signature verification — that only helps against a caller who
cannot already supply an arbitrary token.

A compatibility-date change means a one-time cold cache for the affected entries. Old entries are not
deleted; on the `file` store, responses carrying an `ETag` were saved with an infinite TTL, so run
`php artisan cache:clear` if you want the space back.

**If you implement `CacheMiddlewareInterface` yourself**, build on `EsiPrivateCacheStrategy` rather than
`Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy` — otherwise your cache keeps the unscoped key and
the cross-character bleed above.

## Rate limiting

ESI enforces a **1800-token / 15-minute** rolling window (one token consumed per request,
irrespective of response code). `esi-client` itself does not throttle — rate limiting is
handled by the consumer layer (`eveapi`) using Laravel Horizon throttle middleware on each
queued job.

If the HTTP client receives a `420 Error Limited` response, the request is retried with
exponential backoff as configured on the job.

## Error handling

Guzzle is an implementation detail: no `GuzzleHttp\Exception\*` type escapes this package.
Everything it throws lives in `Seatplus\EsiClient\Exceptions` and implements the
`EsiClientException` marker interface, so `catch (EsiClientException $e)` catches any
failure originating here.

| Exception | Meaning |
| --- | --- |
| `EsiRateLimitedException` | `429` — token bucket exhausted; `$e->retryAfter` seconds |
| `EsiErrorLimitedException` | `420` — error limit hit; `$e->retryAfter` seconds |
| `RequestFailedException` | Any other error response; `$e->getEsiResponse()` has body and headers |
| `EsiTransportException` | No response at all — DNS, refused connection, TLS, timeout, redirect loop. The underlying client exception is kept as `getPrevious()` |
| `ExpiredRefreshTokenException` | The supplied `access_token` is expired or expires within the minute — refresh it via `UpdateRefreshTokenService` |
| `UriDataMissingException` | A path placeholder had no matching value |

One exception is deliberately **not** covered: `assertScope()` throws
`Seatplus\EsiSchema\Contracts\ScopeAccessDeniedException`, which belongs to `esi-schema`.
Catch it separately if you need it.

```php
try {
    $sdk->withToken($accessToken)->characters()->getCharactersDetail(95725047);
} catch (EsiRateLimitedException $e) {
    // back off for $e->retryAfter seconds
} catch (EsiTransportException $e) {
    // the ESI was unreachable — retry later
} catch (EsiClientException $e) {
    // anything else this package throws
}
```

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

if you plan to use this client with any of these a proper CacheMiddleware would be needed. Build its
strategy on `Seatplus\EsiClient\CacheMiddleware\Strategy\EsiPrivateCacheStrategy` so the cache key stays
scoped to the caller and the compatibility date — see [Caching](#caching).
Same goes to the HTTP client. This client and its cache middleware had been designed to use with Guzzle7 (but you can use it with any PSR-7 HTTP client). Please submit your PR accordingly implementing other HTTP clients.

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Felix Huber](https://github.com/seatplus)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
