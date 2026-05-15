<?php

namespace Seatplus\EsiClient\Exceptions;

use Seatplus\EsiSchema\Contracts\ScopeAccessDeniedException;

/**
 * @deprecated Use \Seatplus\EsiSchema\Contracts\ScopeAccessDeniedException directly.
 * This subclass is kept for backward compatibility with code that catches
 * EsiScopeAccessDeniedException by name.
 */
class EsiScopeAccessDeniedException extends ScopeAccessDeniedException {}
