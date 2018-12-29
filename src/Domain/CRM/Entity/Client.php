<?php

namespace Jet\Domain\CRM\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Company;
use Jet\Domain\Common\Entity\Specification\HasDocumentNumber;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
class Client extends Company
{
    use Timestamps;
    use HasDocumentNumber;

    protected $moduleCode = 'C';
}