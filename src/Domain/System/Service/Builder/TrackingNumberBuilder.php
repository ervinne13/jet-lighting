<?php

namespace Jet\Domain\System\Service\Builder;

use Jet\Domain\System\Entity\TrackingNumber;

class TrackingNumberBuilder
{
    private $code;    
    private $startingNumber = 0;
    private $endingNumber = 99999999;    
    private $isActive = true;
    private $resetsEveryYear = false;

    public function withCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    public function withStartingNumber(int $startingNumber)
    {
        $this->startingNumber = $startingNumber;
        return $this;
    }

    public function withEndingNumber(int $endingNumber)
    {
        $this->endingNumber = $endingNumber;
        return $this;
    }
    
    public function isIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function resetsEveryYear(bool $resetsEveryYear = true)
    {
        $this->resetsEveryYear = $resetsEveryYear;
        return $this;
    }

    public function build() : TrackingNumber
    {
        return new TrackingNumber(
            $this->code,
            $this->startingNumber,
            $this->endingNumber,
            $this->resetsEveryYear,
            $this->isActive
        );
    }
}