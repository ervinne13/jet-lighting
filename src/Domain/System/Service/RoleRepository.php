<?php

namespace Jet\Domain\System\Service;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Jet\Domain\System\Entity\Role;

interface RoleRepository extends ObjectRepository, Selectable
{
    function findByName(string $name) : Role;
}