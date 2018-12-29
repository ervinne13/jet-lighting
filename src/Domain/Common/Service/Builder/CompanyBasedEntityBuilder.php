<?php

namespace Jet\Domain\Common\Service\Builder;

use Jet\Domain\CRM\Entity\Client;
use Jet\Domain\PLD\Entity\Supplier;

class CompanyBasedEntityBuilder
{
    private $name;
    private $address;
    private $contactPerson;
    private $contactNumber;
    private $emailAddress;

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

    public function buildClientCompany() : Client
    {
        return new Client(
            $this->name,
            $this->address,
            $this->contactPerson,
            $this->contactNumber,
            $this->emailAddress
        );
    }

    public function buildSupplier() : Supplier
    {
        return new Supplier(
            $this->name,
            $this->address,
            $this->contactPerson,
            $this->contactNumber,
            $this->emailAddress
        );
    }
}