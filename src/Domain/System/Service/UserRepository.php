<?php

namespace Jet\Domain\System\Service;

use Jet\Domain\System\Entity\User;
use Jet\Domain\System\ValueObject\Username;

interface UserRepository
{
    function findByUsername(Username $username) : User;
    
    function isRegistered(Username $username) : bool;
}