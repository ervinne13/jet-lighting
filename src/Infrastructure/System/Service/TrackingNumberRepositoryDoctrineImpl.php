<?php

namespace Jet\Infrastructure\System\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\System\Entity\TrackingNumber;
use Jet\Domain\System\Service\TrackingNumberRepository;
use Jet\Domain\System\ValueObject\ModuleCode;

class TrackingNumberRepositoryDoctrineImpl extends EntityRepository implements TrackingNumberRepository
{
    public function findByModuleCode(ModuleCode $moduleCode) : TrackingNumber
    {
        $criteria = ['module' => $moduleCode->getStringVal()];
        return $this->findOneBy($criteria);
    }

    public function findByCode(string $code) : TrackingNumber
    {
        $criteria = ['code' => $code];
        return $this->findOneBy($criteria);
    }
}