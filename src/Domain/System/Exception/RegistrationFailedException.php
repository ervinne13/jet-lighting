<?php

namespace Jet\Domain\System\Exception;

use Exception;
use Jet\Domain\System\ValueObject\Username;

class RegistrationFailedException extends Exception
{
    const USERNAME_ALREADY_EXIST = 1;
    const NON_MATCHING_PASSWORDS = 2;

    public static function fromAlreadyExistingUsername(string $username, Throwable $previous = null) : RegistrationFailedException
    {
        $msg = "Username {$username} is already taken";
        $code = static::USERNAME_ALREADY_EXIST;
        return new static($msg, $code, $previous);
    }

    public static function fromNonMatchingPasswords(Throwable $previous = null) : RegistrationFailedException
    {
        $msg = "Passwords do not match";
        $code = static::NON_MATCHING_PASSWORDS;
        return new static($msg, $code, $previous);
    }
}