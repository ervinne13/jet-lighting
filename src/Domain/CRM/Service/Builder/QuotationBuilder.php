<?php

namespace Jet\Domain\CRM\Service\Builder;

use Jet\Domain\CRM\Entity\Client;
use Jet\Domain\CRM\Entity\Quotation;

class QuotationBuilder
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

    public function withclient(Client $client)
    {
        $this->name             = $client->getName();
        $this->address          = $client->getAddress();
        $this->contactPerson    = $client->getContactPerson();
        $this->contactNumber    = $client->getContactNumber();
        $this->emailAddress     = $client->getEmailAddress();

        $this->refClientTrackingNumber = $client->getDocumentNumber();

        return $this;
    }

    public function build() : Quotation
    {
        return new Quotation(new Client(
            $this->name,
            $this->address,
            $this->contactPerson,
            $this->contactNumber,
            $this->emailAddress
        ));
    }
}