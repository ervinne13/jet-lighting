<?php

namespace Jet\Domain\Security\Exception;

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

    public static function fromInvalidUsernameFormat(string $username, Throwable $previous = null) : InvalidPasswordException
    {
        $msg = "The username {$username} has invalid format.";
        $code = InvalidPasswordException::INVALID_USERNAME;
        return new InvalidPasswordException($msg, $code, $previous);
    }

    public static function fromInvalidPasswordFormat(Throwable $previous = null) : InvalidPasswordException
    {
        $msg = 'Password format is invalid.';
        $code = InvalidPasswordException::INVALID_PASSWORD;
        return new InvalidPasswordException($msg, $code, $previous);
    }
}