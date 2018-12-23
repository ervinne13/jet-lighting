<?php

namespace Jet\Domain\Security\Exception;

use Exception;
use Jet\Domain\Security\ValueObject\Username;

class RegistrationFailedException extends Exception
{
    const USERNAME_ALREADY_EXIST = 1;
    const NON_MATCHING_PASSWORDS = 2;

    public static function fromAlreadyExistingUsername(Username $username, Throwable $previous = null) : RegistrationFailedException
    {
        $msg = "Username {$username->getStringValue()} is already taken";
        $code = RegistrationFailedException::USERNAME_ALREADY_EXIST;
        return new RegistrationFailedException($msg, $code, $previous);
    }

    public static function fromNonMatchingPasswords(Throwable $previous = null) : RegistrationFailedException
    {
        $msg = "Passwords do not match";
        $code = RegistrationFailedException::NON_MATCHING_PASSWORDS;
        return new RegistrationFailedException($msg, $code, $previous);
    }
}