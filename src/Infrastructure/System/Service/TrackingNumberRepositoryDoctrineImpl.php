<?php

namespace Jet\Infrastructure\System\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\System\Service\TrackingNumberRepository;

class TrackingNumberRepositoryDoctrineImpl extends EntityRepository implements TrackingNumberRepository
{
  
}