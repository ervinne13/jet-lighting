<?php

namespace Jet\Domain\Common\Entity\Specification;

use Doctrine\ORM\EntityManagerInterface;
use Jet\Domain\System\Entity\TrackingNumber;
use Jet\Domain\System\Service\TrackingNumberRepository;
use Jet\Domain\System\ValueObject\ModuleCode;

trait HasMutableId
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     * @var string
     */
    protected $id;

    /**
     * @var TrackingNumber
     */
    protected $trackingNumber;

    public function getId() : ?string
    {
        return $this->id;
    }

    public function reserveId() : void
    {
        $trackingNumber = $this->getTrackingNumber();
        $this->id = $trackingNumber->getNextAvailableStringVal();
    }

    public function refreshId() : void
    {
        $this->reserveId();
    }

    public function commitAndPersist(EntityManagerInterface $em) : string
    {
        $trackingNumber = $this->getTrackingNumber();
        $this->id = $trackingNumber->commit();

        $em->persist($trackingNumber);
        $em->persist($this);  
        
        return $this->id;
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