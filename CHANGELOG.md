# Changelog

All notable changes to `esi-client` will be documented in this file.
Releases before 5.0.0 are documented in the [GitHub releases](https://github.com/seatplus/esi-client/releases).

## 5.0.0 - unreleased

`5.x` is the PHP 8.5 line and tracks `seatplus/esi-schema` `^4.1 || ^5.0`. `4.x` remains on PHP 8.3+
and ESI `2025-12-16` and receives bug fixes only.

The ESI compatibility date is no longer a property of this package: it is read from whichever
esi-schema release Composer resolves, so `composer update` can move it without an esi-client release.
esi-schema `4.1.0` sends `2026-07-21`; `5.0.0` sends `2026-08-04`.

### Breaking

- **PHP 8.5 is now the minimum** (`php: ^8.5`, was `^8.3`). PHP 8.3 and 8.4 consumers must stay on
  `4.1.x`; `composer update` will hold them there silently rather than reporting a conflict.
- **`seatplus/esi-schema` is now `^4.1 || ^5.0`** (was `^1.3`). esi-schema 3.0 raised its own floor to
  PHP 8.5, and every release from 3.0 onwards is a breaking DTO release; no version of this package
  accepts both `1.x` and `4.x`. The range is deliberately open at the top — esi-schema tags each ESI
  spec sync off its `main` branch, which is the `5.x` line, so a constraint capped at `^4.1` would
  freeze both the DTOs and the compatibility date at `2026-07-21` for good. Everything below is the
  aggregate delta from esi-schema `1.3` to `5.0`.
- **The compatibility date sent on every request moved `2025-12-16` → `2026-07-21` or `2026-08-04`,**
  depending on the esi-schema release in the lock file. `X-Compatibility-Date` is no longer a literal
  in this package — it is read from `Seatplus\EsiSchema\GeneratedSpec::COMPATIBILITY_DATE`, so the
  generated DTOs and the wire contract cannot drift apart, at the cost of the wire behaviour of a
  fixed esi-client version following esi-schema. 21 routes in the OpenAPI document carry a per-route
  compatibility date later than `4.x`'s `2025-12-16`, so their response shape changes for anyone
  upgrading from `4.x`:
  - `2026-05-19` (12): the `access-lists`, `mercenary-tactical-operations`,
    `structures/mercenary-dens`, `structures/skyhooks`, `structures/sovereignty-hubs`,
    `/skyhooks/raidable` and `/sovereignty/systems` routes.
  - `2026-06-09` (1): `/characters/{character_id}`.
  - `2026-07-17` (1): `/meta/name`.
  - `2026-07-21` (1): `/corporations/{corporation_id}`.
  - `2026-08-04` (6): the `military-campaigns` routes — new in esi-schema `5.0.0`, so the step from
    `4.1` to `5.0` changes no *existing* route's shape.

  Re-verify anything that reads ESI fields directly rather than through the generated DTOs.
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
- **`Responses\StatusGet` is now `Responses\Status`** (esi-schema `5.0.0`), and
  `StatusResource::getStatus()` / `Status\GetStatus::execute()` return that type. CCP renamed the
  component schema behind the `/status` 200 response; the route, operation id, scope and cache metadata
  are untouched. `Status::$vip` also tightened from `?bool` to a required `bool`. Nothing in this
  package names `StatusGet`, so it is a rename for consumers only.
- **Every public snake_case property, promoted or otherwise, is now camelCase.** Named arguments and
  property reads on this package's DTOs must be renamed — this is the change that breaks consumers
  hardest, because none of it is a type error the compiler can point at. `EsiConfiguration` is
  constructed with named arguments across the chain, so a missed rename surfaces as an
  `Unknown named parameter` at runtime.

  | class | old | new |
  |---|---|---|
  | `EsiAuthentication` | `$access_token`, `$refresh_token`, `$client_id`, `$token_expires` | `$accessToken`, `$refreshToken`, `$clientId`, `$tokenExpires` |
  | `EsiResponse` | `$raw_headers`, `$parsed_headers`, `$response_code`, `$error_limit_remain`, `$error_limit_reset` | `$rawHeaders`, `$parsedHeaders`, `$responseCode`, `$errorLimitRemain`, `$errorLimitReset` |
  | `EsiConfiguration` | `$http_user_agent`, `$esi_scheme`, `$esi_host`, `$esi_port`, `$logger_level`, `$logfile_location`, `$log_max_files`, `$cache_middleware`, `$compatibility_date` | `$httpUserAgent`, `$esiScheme`, `$esiHost`, `$esiPort`, `$loggerLevel`, `$logfileLocation`, `$logMaxFiles`, `$cacheMiddleware`, `$compatibilityDate` |
  | `RequestFailedException` | `$original_exception` (constructor parameter) | `$originalException` |
  | `VerifyAccessToken::verify()` | `$access_token` | `$accessToken` |

  `$logger`, `$fetcher` and `$secret` were already single-word and are unchanged. Laravel *config
  keys* on the consumer side stay snake_case — a config key and the property it is assigned to are
  independent (`$config->logfileLocation = config('eveapi.config.esi-client.logfile_location')`), as do
  ESI/SSO wire field names (`access_token`, `refresh_token`, `grant_type`) and esi-schema DTO fields,
  which mirror the JSON payload.
- **`EsiConfiguration::$datasource`, `$sso_scheme`, `$sso_host` and `$sso_port` were deleted.**
  `$datasource` no longer exists in the ESI OpenAPI document — it is a Singularity/Serenity-era
  parameter — yet `buildDataUri()` appended `?datasource=tranquility` to every request and therefore to
  every RFC 7234 cache key. The three `sso_*` values had no readers anywhere: the SSO endpoints are
  constants (`UpdateRefreshTokenService::TOKEN_URL`, `VerifyAccessToken::JWKS_URL`). Two consequences:
  every outgoing request URL changes, which invalidates existing cache entries by giving them new keys
  (harmless — they age out), and the constructor signature shortens, so any *positional*
  `new EsiConfiguration(...)` shifts. Use named arguments.
- **The HTTP cache key is now scoped to the caller and the compatibility date.**
  `LaravelFileCacheMiddleware` now builds `EsiPrivateCacheStrategy`, keying on
  `sha256(compatibility-date | token subject | method + URI)` instead of method + URI alone. Entries
  cached by `4.x` are unreachable from 5.0.0, so expect one cold-fetch cycle per endpoint after
  upgrading and budget for it against ESI's 1800-request / 15-minute window. Old entries are not
  deleted; `php artisan cache:clear` reclaims the space.
- **No `GuzzleHttp\Exception\*` type escapes this package any more.** Transport failures that never
  produced a response — DNS failure, refused connection, TLS error, timeout, redirect loop — used to
  propagate as raw Guzzle types from `GuzzleFetcher::httpRequest()` and
  `UpdateRefreshTokenService::getRefreshTokenResponse()`, and (undocumented) from
  `VerifyAccessToken::verify()`. All three now throw
  `Seatplus\EsiClient\Exceptions\EsiTransportException` with the original exception kept as
  `getPrevious()`, and the `@throws GuzzleException` docblocks are gone. Response-bearing failures are
  unaffected: `429` still throws `EsiRateLimitedException`, `420` `EsiErrorLimitedException`, and
  everything else `RequestFailedException`. Any consumer that catches `GuzzleException` around an
  esi-client call must catch `EsiTransportException` instead — no such runtime catch site exists in
  `eveapi`, `auth`, `web`, or `core`, so in practice this only removes the stale `@throws` line in
  eveapi.

### Added

- **`Seatplus\EsiClient\Exceptions\EsiClientException`**, a marker interface implemented by every
  exception this package throws, so consumers can `catch (EsiClientException $e)` for "any esi-client
  failure" instead of enumerating six concrete types. Purely additive — the existing parent classes
  (`\Exception` / `\RuntimeException`) are unchanged, so current catch sites keep working.
  `ScopeAccessDeniedException` is deliberately excluded: it belongs to `esi-schema`.

### Fixed

- **Authenticated responses could be served to the wrong character.** ESI does not send
  `Vary: Authorization`, and the cache key did not include the token, so two characters requesting the
  same authenticated URI shared one entry — a character lacking a corporation role could be served a
  payload another character fetched, with ESI never seeing the request it would have refused. Because
  ESI sends `ETag`, those entries were stored with an infinite TTL and did not age out. The key now
  includes the access token's JWT `sub`, which is stable across token refresh. Only deployments that
  opted into a response cache were affected; the shipped default is `NullCacheMiddleware`, which
  caches nothing.
- **`skills()->getCharactersCharacterIdSkillqueue()` returned nothing.** esi-schema `3.0.0` generated
  that operation with `data: null` — the only operation in the document declaring its response body
  inline — so the call succeeded and silently yielded an empty payload. esi-schema `4.0.0` hydrates
  `CharactersSkillqueueSkill` DTOs again and refuses to generate any operation whose declared body it
  cannot type. Seven POSTs that declare their body under `201` rather than `200` (`wing_id`,
  `squad_id`, `fitting_id`, the new mail's id, the CSPA cost) are typed for the first time as well.
  Pinned here by tests over full, empty and nullable-field queues.
- **The HTTP method token is now uppercased at the transport boundary.** esi-schema `≤4.0` emitted
  `invoke('get', …)` for all 219 generated call sites, and `EsiTransportInterface` never specified the
  casing. RFC 9110 §9.1 makes method tokens case-sensitive; Guzzle 7 silently uppercased, deprecated
  that in 7.11, and 8.0 sends the verb verbatim. `GuzzleFetcher::httpRequest()` normalises it once, so
  the fix holds regardless of what the generator emits (esi-schema `4.1.0` also fixed it upstream).

### Action required

- **If you implement `CacheMiddlewareInterface` yourself**, your code still compiles and runs, but it
  keeps the unscoped cache key and the cross-character bleed described above. Build your
  `CacheMiddleware` on `Seatplus\EsiClient\CacheMiddleware\Strategy\EsiPrivateCacheStrategy` instead of
  `Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy`. Consumers using the shipped
  `LaravelFileCacheMiddleware` need no change.

### Changed

- **`kevinrob/guzzle-cache-middleware` is now `^8.0`** (was `^7.0`). `7.0.0`'s
  `CacheEntry::getResponse()` passed an `int` to `withHeader('Age', …)`, which psr7 3.0 rejects; `8.0`
  casts it to `string`. A drop-in on Guzzle 7 (`^7.9.2 || ^8.0`) — `isVaryEquals()`,
  `getVaryHeaders()`, `getTTL()`, `getCacheStorage()` and the `X-Kevinrob-Cache` constants all survive,
  and the `PrivateCacheStrategy` diff touches only `getCacheObject()`, which
  `EsiPrivateCacheStrategy` does not override. `LaravelCacheStorage::fetch()` also moves from an
  unrestricted `unserialize()` to one bounded by `allowed_classes`. Together with esi-schema `4.0` this
  takes the suite from 12 deprecations to zero, and `phpunit.xml.dist` now sets
  `failOnDeprecation="true"` so they cannot come back.
- `guzzlehttp/guzzle` is now declared explicitly in `require`. It was already used directly by
  `GuzzleFetcher` while arriving only transitively through the cache middleware. It stays at `^7.9.2`:
  `laravel/framework` still requires `^7.8.2`, so widening to `^7.9.2 || ^8.0` would make CI resolve
  Guzzle 8 while consumers run 7.
- `illuminate/cache` (dev) widened to `^11.23 || ^12.0 || ^13.0` to cover the Laravel line consumers
  actually run.

### Unchanged

`EsiClient::invoke()`, `EsiTransportInterface`, `EsiRawResponse`, `EsiCursor`, `EsiResult`,
`AbstractEsiDto`, every `EsiClient` resource factory method (the `compatibilityDate` constructor
argument still accepts an override, and `null` still omits the header), authentication, logging, and
rate-limit/error-limit handling.

### Known gaps

`EsiClient` exposes one factory method per ESI tag group and the list is hand-maintained, so four of
esi-schema `5.0.0`'s 37 tag wrappers have no accessor: `AccessListResource`, `ActivitiesResource`,
`StructuresResource` and `MilitaryCampaignsResource`. They are reachable in the meantime by
construction, since `EsiClient` is the transport — `new MilitaryCampaignsResource($esiClient)`.

## 1.0.0 - 202X-XX-XX

- initial release
