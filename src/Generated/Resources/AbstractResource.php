<?php

namespace Seatplus\EsiClient\Generated\Resources;

use Seatplus\EsiClient\EsiClient;

/**
 * Base class for all generated ESI resource classes.
 * Each resource group corresponds to one ESI tag.
 */
abstract class AbstractResource
{
    public function __construct(
        protected readonly EsiClient $client,
    ) {}
}
