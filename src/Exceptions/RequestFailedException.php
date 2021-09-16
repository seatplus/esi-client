<?php

namespace Seatplus\EsiClient\Exceptions;

use JetBrains\PhpStorm\Pure;
use Seatplus\EsiClient\DataTransferObjects\EsiResponse;
use Throwable;

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

    /**
     * @return EsiResponse
     */
    public function getEsiResponse(): EsiResponse
    {
        return $this->esiResponse;
    }

    /**
     * @return \Exception
     */
    public function getOriginalException(): \Exception
    {
        return $this->original_exception;
    }

    #[Pure]
    public function getErrorMessage(): string
    {

        return $this->getEsiResponse()->getErrorMessage();
    }

}
