<?php

namespace Jet\Domain\Common\ValueObject;

use Exception;

abstract class TextLengthInvariant
{
    /** @var string */
    private $value;    

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    private function validate($value) : void
    {
        $passes = strlen($value) >= config('security.min_password_length');
        if (!$passes) {
            throw $this->getExceptionToThrowOnInvalidValue($value);            
        }
    }

    protected abstract function getRequiredTextLength() : int;

    protected abstract function getExceptionToThrowOnInvalidValue(string $value) : Exception;

    public function getStringVal() : string
    {
        return $this->value;
    }
}