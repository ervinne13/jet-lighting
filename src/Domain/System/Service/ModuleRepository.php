<?php

namespace Jet\Domain\System\Service;

use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\ValueObject\ModuleCode;

interface ModuleRepository
{
    function findByCode(ModuleCode $code) : Module;

    function findAllActive() : array;
}