<?php

namespace Jet\Domain\CRM\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Specification\HasTrackingNumber;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="client_companies")
 */
class ClientCompany
{
    use Timestamps;
    use HasTrackingNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="string", name="contact_person")
     */
    private $contactPerson;

    /**
     * @ORM\Column(type="string", name="contact_number")
     */
    private $contactNumber;

    /**
     * @ORM\Column(type="string", name="email_address")
     */
    private $emailAddress;

    public function __construct(
        string $name,
        string $address,
        string $contactPerson,
        string $contactNumber,
        string $emailAddress
    ) {
        $this->name             = $name;
        $this->address          = $address;
        $this->contactPerson    = $contactPerson;
        $this->contactNumber    = $contactNumber;
        $this->emailAddress     = $emailAddress;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getAddress() : string
    {
        return $this->address;
    }

    public function getContactPerson() : string
    {
        return $this->contactPerson;
    }

    public function getContactNumber() : string
    {
        return $this->contactNumber;
    }

    public function getEmailAddress() : string
    {
        return $this->emailAddress;
    }
}