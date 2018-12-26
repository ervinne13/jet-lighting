<?php

namespace Jet\Domain\Common\Entity;

use Doctrine\ORM\Mapping AS ORM;
use JsonSerializable;

class Company implements JsonSerializable
{

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $address;

    /**
     * @ORM\Column(type="string", name="contact_person")
     */
    protected $contactPerson;

    /**
     * @ORM\Column(type="string", name="contact_number")
     */
    protected $contactNumber;

    /**
     * @ORM\Column(type="string", name="email_address")
     */
    protected $emailAddress;

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

    public function jsonSerialize() 
    {
        return [
            'name'          => $this->name,
            'address'       => $this->address,
            'contactPerson' => $this->contactPerson,
            'contactNumber' => $this->contactNumber,
            'emailAddress'  => $this->emailAddress
        ];
    }
}