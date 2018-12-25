<?php

namespace Jet\Infrastructure\System\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\Service\ModuleRepository;
use Jet\Domain\System\ValueObject\ModuleCode;

class ModuleRepositoryDoctrineImpl extends EntityRepository implements ModuleRepository
{
    public function findByCode(ModuleCode $code) : Module
    {
        return $this->findOneBy(['code' => $code->getStringVal()]);
    }

    public function findAllActive() : array
    {
        return $this->findBy(['is_active' => true]);
    }
}