<?php

namespace Jet\Infrastructure\System\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\PLD\Service\SupplierRepository;

class SupplierRepositoryDoctrineImpl extends EntityRepository implements SupplierRepository
{
  
}