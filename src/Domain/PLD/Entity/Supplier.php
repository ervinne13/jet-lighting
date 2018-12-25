<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Company;
use Jet\Domain\Common\Entity\Specification\HasMutableId;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="suppliers")
 */
class Supplier extends Company
{
    use Timestamps;
    use HasMutableId;
    
}