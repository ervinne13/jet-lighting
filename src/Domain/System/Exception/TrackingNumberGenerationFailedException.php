<?php

namespace Jet\Domain\System\Exception;

use Exception;
use Jet\Domain\System\Entity\TrackingNumber;

class TrackingNumberGenerationFailedException extends Exception
{
    const EXHAUSTED = 1;

    public static function fromExhaustedNumbers(TrackingNumber $tn, Throwable $previous = null) : TrackingNumberGenerationFailedException
    {
        $msg = "Unable to generate tracking number for {$tn->getCode()}, it's numbers are already exhausted.";
        $code = static::EXHAUSTED;
        return new static($msg, $code, $previous);
    }
}