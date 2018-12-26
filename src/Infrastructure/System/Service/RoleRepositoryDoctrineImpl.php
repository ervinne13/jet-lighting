<?php

namespace Jet\Infrastructure\System\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\Service\RoleRepository;

class RoleRepositoryDoctrineImpl extends EntityRepository implements RoleRepository
{
    public function findByName(string $name) : Role
    {
        $criteria = ['name' => $name];
        return $this->findOneBy($criteria);
    }
}