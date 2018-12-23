<?php

namespace Jet\Domain\Security\ValueObject;

use Exception;
use Jet\Domain\Common\ValueObject\TextLengthInvariant;
use Jet\Domain\Security\Exception\InvalidCredentialFormatException;

/**
 * Invariant for usernames.
 * This will allow us an early detection system for 
 * authentication (not just registration).
 * 
 * This means we can show invalid username or password
 * error on the frontend without even querying
 */
class Username extends TextLengthInvariant
{
    protected function getRequiredTextLength() : int
    {
        return config('security.min_username_length');
    }

    protected function getExceptionToThrowOnInvalidValue(string $value) : Exception
    {
        return InvalidCredentialFormatException::fromInvalidUsernameFormat($value);
    }
}