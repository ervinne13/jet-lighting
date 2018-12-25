<?php

namespace Jet\Domain\CRM\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Company;
use Jet\Domain\Common\Entity\Specification\HasDocumentNumber;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="client_companies")
 */
class ClientCompany extends Company
{
    use Timestamps;
    use HasDocumentNumber;
}