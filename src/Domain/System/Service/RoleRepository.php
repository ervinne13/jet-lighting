<?php

namespace Jet\Domain\System\Service;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface RoleRepository extends ObjectRepository, Selectable
{
    
}