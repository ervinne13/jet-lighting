<?php

namespace Jet\Domain\System\Service;

use Jet\Domain\System\Entity\User;
use Jet\Domain\System\ValueObject\Username;

interface ModuleRepository
{
    function getAllActive() : array;
}