<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\CacheMiddleware\Strategy;

use Firebase\JWT\JWT;
use Kevinrob\GuzzleCache\KeyValueHttpHeader;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Psr\Http\Message\RequestInterface;
use Seatplus\EsiSchema\GeneratedSpec;

/**
 * RFC 7234 private cache scoped to the caller and to the ESI compatibility date.
 *
 * Upstream keys on method + URI only. ESI does not vary on Authorization, so two characters
 * requesting the same authenticated URI share one entry — a character lacking a corporation
 * role can be served a payload another character fetched, and ESI never sees the request that
 * would have been refused. Entries carrying an ETag are stored with an infinite TTL, so that
 * bleed does not age out. Scoping the key to the token's subject fixes it without the cost of
 * keying on the raw bearer token, which rotates every ~20 minutes and would miss more often
 * than ESI's TTLs allow.
 *
 * The compatibility date is folded in as well. ESI currently sends
 * `Vary: X-Compatibility-Date`, which the vendor already honours, so this salt is defence in
 * depth should CCP stop sending it — not a fix for a live bug.
 *
 * The `sub` claim is read without signature verification. That is strictly better than keying
 * on nothing and strictly weaker than keying on the raw token: it only helps against a caller
 * who cannot already supply an arbitrary token.
 */
class EsiPrivateCacheStrategy extends PrivateCacheStrategy
{
    #[\Override]
    protected function getCacheKey(RequestInterface $request, ?KeyValueHttpHeader $varyHeaders = null): string
    {
        $compatibilityDate = $request->getHeaderLine(GeneratedSpec::COMPATIBILITY_DATE_HEADER);

        return hash(
            'sha256',
            $compatibilityDate.'|'.$this->tokenIdentity($request).'|'.parent::getCacheKey($request, $varyHeaders),
        );
    }

    /**
     * Stable identity of the OAuth principal, or '' for an unauthenticated request.
     *
     * Falls back to hashing the raw header when the token is not a readable JWT: isolation at
     * the cost of caching only for that token's lifetime.
     */
    private function tokenIdentity(RequestInterface $request): string
    {
        $authorization = $request->getHeaderLine('Authorization');

        if ($authorization === '') {
            return '';
        }

        $segments = explode('.', $authorization);

        if (count($segments) < 3) {
            return hash('sha256', $authorization);
        }

        $payload = json_decode(JWT::urlsafeB64Decode($segments[1]));

        if (is_object($payload) && isset($payload->sub) && is_string($payload->sub)) {
            return $payload->sub;
        }

        return hash('sha256', $authorization);
    }
}
