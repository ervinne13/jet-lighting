<?php

namespace Jet\Domain\CRM\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Specification\HasDocumentNumber;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="quotation_headers")
 */
class Quotation
{
    use Timestamps;
    use HasDocumentNumber;

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

    /**
     * @ORM\Column(type="string", name="ref_client_tracking_number", nullable=true)
     */
    private $refClientTrackingNumber;

    public function __construct(ClientCompany $clientCompany) 
    {
        $this->name             = $clientCompany->getName();
        $this->address          = $clientCompany->getAddress();
        $this->contactPerson    = $clientCompany->getContactPerson();
        $this->contactNumber    = $clientCompany->getContactNumber();
        $this->emailAddress     = $clientCompany->getEmailAddress();

        $this->refClientTrackingNumber = $clientCompany->getDocumentNumber();
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

    public function getRefClientTrackingNumber() : ?string
    {
        return $this->refClientTrackingNumber;
    }
}