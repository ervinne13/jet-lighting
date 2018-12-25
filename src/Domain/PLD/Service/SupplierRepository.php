<?php

namespace Jet\Domain\PLD\Service;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface SupplierRepository extends ObjectRepository, Selectable
{
    
}