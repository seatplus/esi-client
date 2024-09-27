<?php

namespace Seatplus\EsiClient\Exceptions;

use Seatplus\EsiClient\DataTransferObjects\EsiResponse;

class RequestFailedException extends \Exception
{
    public function __construct(private \Exception $original_exception, private EsiResponse $esiResponse)
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
        return $this->original_exception;
    }

    public function getErrorMessage(): string
    {
        return $this->getEsiResponse()->getErrorMessage();
    }
}
