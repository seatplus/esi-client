<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\Exceptions;

/**
 * Marker interface implemented by every exception esi-client throws.
 *
 * Consumers that only care that "the ESI call failed" can catch this instead of
 * enumerating the concrete types — and without reaching for the HTTP client's
 * exception hierarchy, which is an implementation detail of this package.
 */
interface EsiClientException extends \Throwable {}
