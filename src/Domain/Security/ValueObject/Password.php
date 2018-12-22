<?php

namespace Jet\Domain\Security\ValueObject;

use Jet\Domain\Common\ValueObject\TextLengthInvariant;
use Jet\Domain\Security\Exception\InvalidCredentialFormatException;

/**
 * Invariant for passwords.
 * This will allow us an early detection system for 
 * authentication (not just registration).
 * 
 * This means we can show invalid username or password
 * error on the frontend without even querying
 */
class Password extends TextLengthInvariant
{
    public function getHashed() : string
    {
        
    }

    protected function getRequiredTextLength() : int
    {
        return config('security.min_password_length');
    }

    protected function getExceptionToThrowOnInvalidValue(string $value) : Exception
    {
        return InvalidCredentialFormatException::fromInvalidPasswordFormat();
    }
}