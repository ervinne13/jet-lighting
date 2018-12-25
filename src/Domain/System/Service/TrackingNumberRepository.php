<?php

namespace Jet\Domain\System\Service;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Jet\Domain\System\Entity\TrackingNumber;
use Jet\Domain\System\ValueObject\ModuleCode;

interface TrackingNumberRepository extends ObjectRepository, Selectable
{
    function findByModuleCode(ModuleCode $moduleCode) : TrackingNumber;

    function findByCode(string $code) : TrackingNumber;
}