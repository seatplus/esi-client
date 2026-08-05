<?php

declare(strict_types=1);

namespace Seatplus\EsiClient\Exceptions;

use Seatplus\EsiClient\DataTransferObjects\EsiResponse;

class RequestFailedException extends \Exception implements EsiClientException
{
    public function __construct(private readonly \Exception $originalException, private readonly EsiResponse $esiResponse)
    {
        parent::__construct(
            $this->getErrorMessage(),
            $this->getOriginalException()->getCode(),
            $this->getOriginalException()->getPrevious()
        );
    }

    public function getEsiResponse(): EsiResponse
    {
        return $this->esiResponse;
    }

    public function getOriginalException(): \Exception
    {
        return $this->originalException;
    }

    public function getErrorMessage(): string
    {
        return $this->getEsiResponse()->getErrorMessage();
    }
}
