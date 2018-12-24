<?php

namespace Jet\Domain\System\Exception;

use Exception;

/**
 * This is meant to be an exception that's always caught,
 * so we don't need to be explicit on why the password
 * is invalid, let Laravel's validation or the application 
 * layer do that.
 */
class InvalidCredentialFormatException extends Exception
{
    const INVALID_USERNAME = 1;
    const INVALID_PASSWORD = 2;

    public static function fromInvalidUsernameFormat(string $username, Throwable $previous = null) : InvalidCredentialFormatException
    {
        $msg = "The username {$username} must be longer than 8 characters.";
        $code = static::INVALID_USERNAME;
        return new static($msg, $code, $previous);
    }

    public static function fromInvalidPasswordFormat(Throwable $previous = null) : InvalidCredentialFormatException
    {
        $msg = 'Password must be longer than 8 characters.';
        $code = static::INVALID_PASSWORD;
        return new static($msg, $code, $previous);
    }
}