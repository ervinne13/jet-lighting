<?php

namespace Jet\Domain\Common\Entity\Specification;

use Doctrine\ORM\EntityManagerInterface;
use Jet\Domain\System\Entity\TrackingNumber;
use Jet\Domain\System\Service\TrackingNumberRepository;
use Jet\Domain\System\ValueObject\ModuleCode;

trait HasDocumentNumber
{
    /**
     * @ORM\Id
     * @ORM\Column(name="document_number", type="string")
     * @var string
     */
    protected $documentNumber;

    /**
     * @var TrackingNumber
     */
    protected $trackingNumber;

    public function getDocumentNumber() : ?string
    {
        return $this->documentNumber;
    }

    public function reserveDocumentNumber() : void
    {
        $trackingNumber = $this->getTrackingNumber();
        $this->documentNumber = $trackingNumber->getNextAvailableStringVal();
    }

    public function refreshDocumentNumber() : void
    {
        $this->reserveDocumentNumber();
    }

    public function commitAndPersist(EntityManagerInterface $em) : string
    {
        $trackingNumber = $this->getTrackingNumber();
        $this->documentNumber = $trackingNumber->commit();

        $em->persist($trackingNumber);
        $em->persist($this);       
        
        return $this->documentNumber;
    }

    public function getTrackingNumber() : TrackingNumber
    {
        if (!$this->trackingNumber) {
            $repository = app(TrackingNumberRepository::class);
            $this->trackingNumber = $repository->findByModuleCode(ModuleCode::fromString($this->moduleCode));
        } 

        return $this->trackingNumber;
    }
}