<?php

namespace Jet\Domain\Common\Entity\Specification;

trait HasTrackingNumber
{
    /**
     * @ORM\Id
     * @ORM\Column(name="tracking_number", type="string")     
     * @var string
     */
    protected $trackingNumber;

    public function getTrackingNumber() : string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(string $trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }
}