<?php

namespace Jet\Domain\CRM\Entity;

use LaravelDoctrine\Extensions\Timestamps\Timestamps;

class ClientCompany
{
    use Timestamps;

    private $name;
    private $address;
    private $contactPerson;
    private $contactNumber;
    private $emailAddress;
}