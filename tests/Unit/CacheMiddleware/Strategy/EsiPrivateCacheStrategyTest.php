<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Kevinrob\GuzzleCache\CacheEntry;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\VolatileRuntimeStorage;
use Seatplus\EsiClient\CacheMiddleware\Strategy\EsiPrivateCacheStrategy;
use Seatplus\EsiClient\EsiConfiguration;
use Seatplus\EsiClient\Fetcher\GuzzleFetcher;
use Seatplus\EsiClient\Log\NullLogger;
use Seatplus\EsiSchema\GeneratedSpec;

function esiCacheRequest(?string $compatibilityDate = null, ?string $token = null): Request
{
    $headers = [];

    if ($compatibilityDate !== null) {
        $headers[GeneratedSpec::COMPATIBILITY_DATE_HEADER] = $compatibilityDate;
    }

    if ($token !== null) {
        $headers['Authorization'] = "Bearer {$token}";
    }

    return new Request('GET', 'https://esi.evetech.net/characters/95725047/', $headers);
}

/**
 * Cacheable purely by max-age — deliberately no ETag/Last-Modified, which would make the entry
 * revalidatable and require the transport to serve a 304.
 */
function esiCacheableResponse(string $body, array $headers = []): Response
{
    return new Response(200, array_merge(['Cache-Control' => 'max-age=3600'], $headers), $body);
}

function esiJwt(array $claims): string
{
    return buildJWT(json_encode($claims));
}

it('serves a hit for an identical request', function () {
    $strategy = new EsiPrivateCacheStrategy(new VolatileRuntimeStorage);

    expect($strategy->cache(esiCacheRequest('2026-07-21'), esiCacheableResponse('{"name":"A"}')))->toBeTrue();

    $hit = $strategy->fetch(esiCacheRequest('2026-07-21'));

    expect($hit)->toBeInstanceOf(CacheEntry::class)
        ->and($hit?->getResponse()->getBody()->getContents())->toBe('{"name":"A"}');
});

it('misses when the compatibility date changed', function () {
    $strategy = new EsiPrivateCacheStrategy(new VolatileRuntimeStorage);

    $strategy->cache(esiCacheRequest('2026-07-21'), esiCacheableResponse('{"name":"A"}'));

    expect($strategy->fetch(esiCacheRequest('2025-12-16')))->toBeNull();
});

it('keeps requests without a compatibility date in their own keyspace', function () {
    $strategy = new EsiPrivateCacheStrategy(new VolatileRuntimeStorage);

    $strategy->cache(esiCacheRequest(), esiCacheableResponse('{"name":"undated"}'));

    expect($strategy->fetch(esiCacheRequest()))->toBeInstanceOf(CacheEntry::class)
        ->and($strategy->fetch(esiCacheRequest('2026-07-21')))->toBeNull();

    $dated = new EsiPrivateCacheStrategy(new VolatileRuntimeStorage);
    $dated->cache(esiCacheRequest('2026-07-21'), esiCacheableResponse('{"name":"dated"}'));

    expect($dated->fetch(esiCacheRequest()))->toBeNull();
});

it('misses when the token belongs to a different character', function () {
    $strategy = new EsiPrivateCacheStrategy(new VolatileRuntimeStorage);

    $accountant = esiJwt(['sub' => 'CHARACTER:EVE:95725047']);
    $other = esiJwt(['sub' => 'CHARACTER:EVE:90000001']);

    $strategy->cache(
        esiCacheRequest('2026-07-21', $accountant),
        esiCacheableResponse('{"balance":42}'),
    );

    expect($strategy->fetch(esiCacheRequest('2026-07-21', $accountant)))->toBeInstanceOf(CacheEntry::class)
        ->and($strategy->fetch(esiCacheRequest('2026-07-21', $other)))->toBeNull();
});

it('does not serve an authenticated payload to an anonymous request', function () {
    $strategy = new EsiPrivateCacheStrategy(new VolatileRuntimeStorage);

    $strategy->cache(
        esiCacheRequest('2026-07-21', esiJwt(['sub' => 'CHARACTER:EVE:95725047'])),
        esiCacheableResponse('{"balance":42}'),
    );

    expect($strategy->fetch(esiCacheRequest('2026-07-21')))->toBeNull();
});

it('isolates tokens it cannot read as a JWT subject', function (array|string $first, array|string $second) {
    $strategy = new EsiPrivateCacheStrategy(new VolatileRuntimeStorage);

    $one = is_array($first) ? esiJwt($first) : $first;
    $two = is_array($second) ? esiJwt($second) : $second;

    $strategy->cache(esiCacheRequest('2026-07-21', $one), esiCacheableResponse('{"name":"A"}'));

    expect($strategy->fetch(esiCacheRequest('2026-07-21', $one)))->toBeInstanceOf(CacheEntry::class)
        ->and($strategy->fetch(esiCacheRequest('2026-07-21', $two)))->toBeNull();
})->with([
    // Opaque, non-JWT tokens: fewer than three dot-separated segments.
    'opaque token' => ['opaque-token-one', 'opaque-token-two'],
    // Readable JWTs that carry no `sub` claim.
    'jwt without sub' => [['scp' => ['esi-assets.read_assets.v1']], ['scp' => ['esi-wallet.read_corporation_wallets.v1']]],
]);

it('still honours a Vary header sent by the server', function () {
    $strategy = new EsiPrivateCacheStrategy(new VolatileRuntimeStorage);

    $strategy->cache(
        esiCacheRequest('2026-07-21'),
        esiCacheableResponse('{"name":"A"}', ['Vary' => 'Accept-Language']),
    );

    expect($strategy->fetch(esiCacheRequest('2026-07-21')))->toBeInstanceOf(CacheEntry::class)
        ->and($strategy->fetch(esiCacheRequest('2025-12-16')))->toBeNull();
});

it('serves a cold cache after the compatibility date changes', function () {
    // Two responses for three calls: the second call is a HIT and never reaches the transport.
    $mock = new MockHandler([
        esiCacheableResponse(json_encode(['name' => 'old-date'])),
        esiCacheableResponse(json_encode(['name' => 'new-date'])),
    ]);

    $stack = HandlerStack::create($mock);
    $stack->push(new CacheMiddleware(new EsiPrivateCacheStrategy(new VolatileRuntimeStorage)), 'cache');

    EsiConfiguration::resetInstance();
    EsiConfiguration::getInstance(compatibilityDate: '2026-07-21');

    $fetcher = new GuzzleFetcher(logger: new NullLogger, client: new Client(['handler' => $stack]));

    $first = $fetcher->call('get', 'https://esi.evetech.net/characters/95725047/');
    $second = $fetcher->call('get', 'https://esi.evetech.net/characters/95725047/');

    expect($first->isCachedLoad())->toBeFalse()
        ->and($second->isCachedLoad())->toBeTrue()
        ->and($second->data->name)->toBe('old-date');

    // Production shape: EsiConfiguration memoises getCacheMiddleware() per instance while
    // compatibilityDate stays publicly mutable, so a strategy that captured the date at
    // construction would reuse the stale key. The tests above also catch that; this one
    // additionally proves GuzzleFetcher puts the header where the strategy reads it.
    EsiConfiguration::getInstance()->compatibilityDate = '2025-12-16';

    $third = $fetcher->call('get', 'https://esi.evetech.net/characters/95725047/');

    expect($third->isCachedLoad())->toBeFalse()
        ->and($third->data->name)->toBe('new-date');

    EsiConfiguration::resetInstance();
});
