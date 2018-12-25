<?php

namespace Jet\Domain\CRM\Service\Builder;

use Jet\Domain\CRM\Entity\ClientCompany;

class ClientCompanyBuilder
{
    private $name;
    private $address;
    private $contactPerson;
    private $contactNumber;
    private $emailAddress;
    private $refClientTrackingNumber;

    public function withName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function withAddress(string $address)
    {
        $this->address = $address;

        return $this;
    }

    public function withContactPerson(string $contactPerson)
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    public function withContactNumber(string $contactNumber)
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    public function withEmailAddress(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function withRefClientTrackingNumber(string $trackingNumber) 
    {
        $this->refClientTrackingNumber = $trackingNumber;

        return $this;
    }

    public function withClientCompany(ClientCompany $clientCompany)
    {
        $this->name             = $clientCompany->getName();
        $this->address          = $clientCompany->getAddress();
        $this->contactPerson    = $clientCompany->getContactPerson();
        $this->contactNumber    = $clientCompany->getContactNumber();
        $this->emailAddress     = $clientCompany->getEmailAddress();

        $this->refClientTrackingNumber = $clientCompany->getDocumentNumber();

        return $this;
    }

    public function build() : ClientCompany
    {
        return new ClientCompany(
            $this->name,
            $this->address,
            $this->contactPerson,
            $this->contactNumber,
            $this->emailAddress
        );
    }
}