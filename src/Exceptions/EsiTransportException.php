<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\Exceptions;

/**
 * The request never produced an HTTP response: DNS failure, refused connection,
 * TLS error, timeout, too many redirects.
 *
 * A response that arrived but carried an error status surfaces as
 * RequestFailedException (or the rate/error-limit exceptions) instead.
 */
class EsiTransportException extends \RuntimeException implements EsiClientException
{
    public function __construct(string $message, ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
