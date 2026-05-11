<?php

namespace Seatplus\EsiClient;

use Seatplus\EsiClient\DataTransferObjects\EsiResponse;

/**
 * Typed wrapper returned by all resource methods.
 *
 * @template T
 */
readonly class EsiResult
{
    /**
     * @param T    $data         The typed response body (DTO or array of DTOs).
     * @param int  $pages        Total pages reported by X-Pages (1 when not paginated).
     * @param bool $isCachedLoad Whether this response was served from the RFC 7234 cache.
     */
    public function __construct(
        public mixed $data,
        public int $pages = 1,
        public bool $isCachedLoad = false,
    ) {}

    /**
     * Build an EsiResult from a raw EsiResponse and already-typed data.
     *
     * @template TData
     * @param  TData  $typedData
     * @return EsiResult<TData>
     */
    public static function fromResponse(EsiResponse $response, mixed $typedData): self
    {
        return new self(
            data: $typedData,
            pages: $response->pages ?? 1,
            isCachedLoad: $response->isCachedLoad(),
        );
    }
}
