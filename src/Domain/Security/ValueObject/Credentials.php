<?php

namespace Jet\Domain\Security\ValueObject;

use Jet\Domain\Security\ValueObject\Password;

class Credentials
{
    /** @var string */
    private $username;

    /** @var Password */
    private $password;
}