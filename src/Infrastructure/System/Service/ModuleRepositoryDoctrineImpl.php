<?php

namespace Jet\Infrastructure\System\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\System\Service\ModuleRepository;

class ModuleRepositoryDoctrineImpl extends EntityRepository implements ModuleRepository
{
    public function getAllActive() : array
    {
        return $this->findBy(['is_active' => true]);
    }
}