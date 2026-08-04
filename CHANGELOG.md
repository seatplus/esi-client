# Changelog

All notable changes to `esi-client` will be documented in this file.
Releases before 5.0.0 are documented in the [GitHub releases](https://github.com/seatplus/esi-client/releases).

## 5.0.0 - unreleased

`5.x` is the PHP 8.5 / ESI `2026-07-21` line. `4.x` remains on PHP 8.3+ and ESI `2025-12-16` and
receives bug fixes only.

### Breaking

- **PHP 8.5 is now the minimum** (`php: ^8.5`, was `^8.3`). PHP 8.3 and 8.4 consumers must stay on
  `4.1.x`; `composer update` will hold them there silently rather than reporting a conflict.
- **`seatplus/esi-schema` is now `^3.0`** (was `^1.3`). esi-schema 3.0 requires PHP 8.5 and is a
  breaking DTO release; no version of this package accepts both `1.x` and `3.x`.
- **The compatibility date sent on every request moved `2025-12-16` → `2026-07-21`.**
  `X-Compatibility-Date` is no longer a literal in this package — it is read from
  `Seatplus\EsiSchema\GeneratedSpec::COMPATIBILITY_DATE`, so the generated DTOs and the wire contract
  can no longer drift apart. In ESI's own terms the effective bucket moves `2020-01-01` →
  `2026-06-09`, so response shapes may have changed for endpoints this package does not itself assert
  against. Re-verify anything that reads ESI fields directly.
- **`CharacterResource::getCharactersCharacterId()` is now `getCharactersDetail()`** — CCP renamed the
  operation at compatibility date `2026-06-09`. The signature is unchanged:
  `getCharactersDetail(int $characterId): CharactersDetail`.
- **`CharactersDetail::$title` was removed.** esi-schema 3.0 replaces it with `?string $corporation_title`
  and `?string $character_title_id`, and adds a required `int $achievement_score`. Consumers persisting
  `title` must choose a replacement explicitly — this is a semantic decision, not a rename.
- **The Sovereignty map and structures operations were removed upstream**
  (`Resources\Sovereignty\GetSovereigntyMap`, `GetSovereigntyStructures`, and the
  `Responses\SovereigntyMapGetItem` / `SovereigntyStructuresGetItem` DTOs). `EsiClient::sovereignty()`
  still exists; those two routes do not.
- **The HTTP cache key is now scoped to the caller and the compatibility date.**
  `LaravelFileCacheMiddleware` now builds `EsiPrivateCacheStrategy`, keying on
  `sha256(compatibility-date | token subject | method + URI)` instead of method + URI alone. Entries
  cached by `4.x` are unreachable from 5.0.0, so expect one cold-fetch cycle per endpoint after
  upgrading and budget for it against ESI's 1800-request / 15-minute window. Old entries are not
  deleted; `php artisan cache:clear` reclaims the space.

### Fixed

- **Authenticated responses could be served to the wrong character.** ESI does not send
  `Vary: Authorization`, and the cache key did not include the token, so two characters requesting the
  same authenticated URI shared one entry — a character lacking a corporation role could be served a
  payload another character fetched, with ESI never seeing the request it would have refused. Because
  ESI sends `ETag`, those entries were stored with an infinite TTL and did not age out. The key now
  includes the access token's JWT `sub`, which is stable across token refresh. Only deployments that
  opted into a response cache were affected; the shipped default is `NullCacheMiddleware`, which
  caches nothing.

### Action required

- **If you implement `CacheMiddlewareInterface` yourself**, your code still compiles and runs, but it
  keeps the unscoped cache key and the cross-character bleed described above. Build your
  `CacheMiddleware` on `Seatplus\EsiClient\CacheMiddleware\Strategy\EsiPrivateCacheStrategy` instead of
  `Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy`. Consumers using the shipped
  `LaravelFileCacheMiddleware` need no change.

### Changed

- `guzzlehttp/guzzle` is now declared explicitly in `require`. It was already used directly by
  `GuzzleFetcher` while arriving only transitively through the cache middleware.
- `illuminate/cache` (dev) widened to `^11.23 || ^12.0 || ^13.0` to cover the Laravel line consumers
  actually run.

### Unchanged

`EsiClient::invoke()`, `EsiTransportInterface`, `EsiRawResponse`, `EsiCursor`, `EsiResult`,
`AbstractEsiDto`, all 36 resource wrappers, `EsiConfiguration`'s public API (the `compatibility_date`
constructor argument still accepts an override), authentication, logging, and rate-limit/error-limit
handling.

## 1.0.0 - 202X-XX-XX

- initial release
