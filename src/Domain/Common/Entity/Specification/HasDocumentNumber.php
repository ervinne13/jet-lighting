<?php

namespace Jet\Domain\Common\Entity\Specification;

trait HasDocumentNumber
{
    /**
     * @ORM\Id
     * @ORM\Column(name="document_number", type="string")
     * @var string
     */
    protected $documentNumber;

    public function getDocumentNumber() : ?string
    {
        return $this->documentNumber;
    }

    public function setDocumentNumber(string $documentNumber)
    {
        $this->documentNumber = $documentNumber;
        return $this;
    }
}