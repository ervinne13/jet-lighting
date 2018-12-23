<?php

namespace Jet\Domain\Security\ValueObject;

use Jet\Domain\Security\ValueObject\Password;
use Jet\Domain\Security\ValueObject\Username;

/**
 * @Immutable
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