<?php

namespace Jet\Domain\System\ValueObject;

use Jet\Domain\System\ValueObject\Password;
use Jet\Domain\System\ValueObject\Username;

/**
 * Immutable value object representing user credentials: username & password
 */
class Credentials
{
    /** @var Username */
    private $username;

    /** @var Password */
    private $password;

    public function __construct(Username $username, Password $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}